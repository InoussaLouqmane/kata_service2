<?php

namespace App\Jobs;

use App\Enums\ExamStatus;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EndExamProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $examId;
    protected $payload;

    public function __construct($examId, $payload)
    {
        $this->examId = $examId;
        $this->payload = $payload;
    }

    public function handle()
    {
        try {
            DB::transaction(function () {
                $exam = Exam::find($this->examId);

                foreach ($this->payload as $student_id => $notes) {
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
        } catch (QueryException | \Exception $exception) {
            Log::error('Erreur lors de la clôture de l\'examen : ' . $exception->getMessage());
        }
    }
}
