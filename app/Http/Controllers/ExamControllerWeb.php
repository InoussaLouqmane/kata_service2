<?php

namespace App\Http\Controllers;

use App\Enums\ExamStatus;
use App\Enums\PaymentStatus;
use App\Enums\TransactionStatus;
use App\Jobs\endExamProcess;
use App\Jobs\ExamAchievementProcess;
use App\Jobs\storeExamProcess;
use App\Jobs\updateExamProcess;
use App\Models\Event;
use App\Models\Exam;
use App\Models\Exam_results;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use HttpSocketException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Builder;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExamControllerWeb extends Controller
{
   public function store(Request $request){

       $request->validate([
           'startDateTime' => 'required',
           'location' => 'required',
           'payload' => 'required',
       ]);


       storeExamProcess::dispatch($request->startDateTime,$request->location, $request->payload);

           return response()->json([
               'success'   => true
           ],201);

   }
   public function modify(Request $request){

       $request->validate([
           'event_id' => 'required',
           'startDateTime' => 'required',
           'location' => 'required',
           'payload' => 'required',
       ]);


       updateExamProcess::dispatch($request->event_id,$request->startDateTime,$request->location, $request->payload);

           return response()->json([
               'success'   => true
           ],201);

   }

    public function simpleUpdate(Request $request, $id)
    {
        return $this->update($request, $id, ExamStatus::INITIATED);
    }



    public function cancelExam(Request $request, $id)
    {
        return $this->update($request, $id, ExamStatus::CANCELLED);
    }

    private function update(Request $request, $id, $status)
    {
        $request->validate([
            'startDateTime' => 'required',
            'location' => 'required',
            'payload' => 'required',
        ]);

        $event = Event::find($id);

        if (!$event) {
            return redirect()->back()->with('fail', 'Événement non trouvé.');
        }

        try {
            DB::transaction(function () use ($request, $event, $status) {
                // Mise à jour de l'événement
                $event->update([
                    'startDate' => $request->startDateTime,
                    'endDate' => $request->startDateTime,
                    'address' => $request->location,
                ]);

                // Mise à jour du statut de l'examen
                $exam = Exam::where('event_id', $event->id)->first();
                if ($exam) {
                    $exam->examStatus = $status;
                    $exam->save();
                }

                // Appel de la méthode pour les données supplémentaires
                $this->extracted($request, $event);
            });

            return redirect()->back()->with('success', 'Mise à jour faite avec succès');
        } catch (QueryException | Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur s\'est produite : ' . $e->getMessage());
        }
    }




    /**
     * @param Request $request
     * @param $event
     * @return void
     */
    public function extracted(Request $request, $event): void
    {
        $payloads = $request->payload;

        $grades = [];
        $students = [];

        foreach ($payloads as $payload) {
            $grades[$payload['grade_id']] = ['cost' => $payload['cost']];

            foreach ($payload['students'] as $student) {

                $students[$student['id']] = [
                    'grade_id' => $payload['grade_id'],
                    'noteKata' => $student['noteKata'],
                    'noteKihon' => $student['noteKihon'],
                    'noteKumite' => $student['noteKumite'],
                    'deliberation' => $student['deliberation'],
                ];
            }
        }


        $event->examResults()->sync($students);
        $event->grades()->sync($grades);
    }

    public function deleteSomeone(Request $request){
        $request->validate([
            'examId' => 'required|exists:events,id',
            'studentId' => 'required|exists:users,id',
        ]);

        $event = Event::find($request->examId);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Événement introuvable.',
            ], 404);
        }
        $student = $event->examResults->where('student_id', $request->studentId)->first();
        $gradeId = $student ? $student->pivot->grade_id : null;

        if (!($gradeId && $event->grades->contains('id', $gradeId))) {
            $event->grades()->detach($gradeId);
        }
        // Détacher l'utilisateur de l'événement
        $event->examResults()->detach($request->studentId);

        return response()->json([
            'success' => true,
            'message' => 'Étudiant supprimé avec succès.',
        ]);
    }

    public function updateSomeone(Request $request)
    {
        $request->validate([
            'examId' => 'required|exists:events,id',
            'studentId' => 'required|exists:users,id',
            'noteKata' => 'nullable',
            'noteKumite' => 'nullable',
            'noteKihon' => 'nullable',
            'gradeId' => 'nullable|exists:grades,id',
            'cost' => 'nullable'
        ]);

        $event = Event::find($request->examId);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Événement introuvable.',
            ], 404);
        }


        $student = $event->examResults()->where('student_id', $request->studentId)->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Étudiant non trouvé pour cet examen.',
            ], 404);
        }


        if($request->cost){
            $event->grades()->attach($request->gradeId, [
                'cost' => $request->cost
            ]);
        }
       if($request->gradeId){
           $event->examResults()->updateExistingPivot($request->studentId, [
               'grade_id'=>$request->gradeId
           ]);

       }else{
           $event->examResults()->updateExistingPivot($request->studentId, [
               'noteKata' => $request->noteKata,
               'noteKumite' => $request->noteKumite,
               'noteKihon' => $request->noteKihon,
               'deliberation'=>$request->deliberation
           ]);
       }

        return response()->json([
            'success' => true,
            'message' => 'Informations de l\'élève mises à jour avec succès.',
        ]);
    }


    public function addSomeOne(Request $request)
    {
        $request->validate([
            'examId' => 'required|exists:events,id',
            'studentId' => 'required|exists:users,id',
            'noteKata' => 'nullable|numeric',
            'noteKumite' => 'nullable|numeric',
            'noteKihon' => 'nullable|numeric',
            'cost' => 'nullable',
            'gradeId' => 'required|exists:grades,id',
        ]);

        $event = Event::find($request->examId);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => "Événement non trouvé"
            ], 404);
        }

        // Vérification de l'existence du grade
        if($event->grades->contains('id', $request->gradeId)) {
            // Ajouter l'étudiant à l'événement pour un grade existant
            $event->examResults()->attach($request->studentId, [
                'grade_id' => $request->gradeId,
                'noteKata' => $request->noteKata,
                'noteKumite' => $request->noteKumite,
                'noteKihon' => $request->noteKihon,
            ]);
        } else {
            // Ajouter un nouveau grade à l'événement avec l'étudiant
            $event->grades()->attach($request->gradeId, [
                'cost' => $request->cost ?? 0
            ]);
            $event->examResults()->attach($request->studentId, [
                'grade_id' => $request->gradeId,
                'noteKata' => $request->noteKata,
                'noteKumite' => $request->noteKumite,
                'noteKihon' => $request->noteKihon,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Étudiant ajouté avec succès."
        ]);
    }



    public function endExam(Request $request)
    {
        $request->validate([
            'examId' => 'required|exists:events,id',
            'payload' => 'required',
        ]);


        try {

            DB::transaction(function () use ($request) {
                $exam = Exam::find($request->examId);

                foreach ($request->payload as $student_id => $notes) {

                    $exam->event->examResults()->updateExistingPivot($student_id, [
                        'noteKata' => $notes[0],
                        'noteKumite' => $notes[1],
                        'noteKihon' => $notes[2],
                        'deliberation' => $notes[3]
                    ]);

                    $student = User::findOrFail($student_id);
                    $average = (($notes[0] + $notes[1] + $notes[2]) / 3) >= 10;

                    if ($average && $notes[4]) {
                        $student->grades()->sync([$notes[4]]);
                        Log::info('L\'étudiant a réussi, grade mis à jour');
                    } else {
                        Log::info('L\'étudiant a échoué ou grade non trouvé');
                    }
                }

                $exam->examStatus = ExamStatus::ENDED;
                $exam->save();
            });
        } catch (QueryException | Exception $exception) {
            Log::error('Erreur lors de la clôture de l\'examen : ' . $exception->getMessage());
        }
    }


    public function archiveExam($id){


        try{
            $exam = Exam::find($id);
            $exam->examStatus = ExamStatus::ARCHIEVED;
            $exam->save();

            ExamAchievementProcess::dispatch($exam);
            return response()->json([
                'success' => true,
            ], 200);

        }catch(QueryException  | HttpSocketException | \Mockery\Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }


}
