<?php

namespace App\Jobs;

use App\Enums\ExamStatus;
use App\Enums\TransactionStatus;
use App\Http\Controllers\pdfController;
use App\Models\Event;
use App\Models\Exam;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class updateExamProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $examId;
    protected $startDateTime;
    protected $location;
    protected $payload;
    public function __construct(
        String $examId,
        String $startDateTime,
        String $location,
               $payload)
    {
        $this->startDateTime = $startDateTime;
        $this->location = $location;
        $this->payload = $payload;
        $this->examId = $examId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $examId = $this->examId;
        $startDateTime = $this->startDateTime;
        $location = $this->location;
        $payload = $this->payload;


        try{

            DB::transaction(function () use($examId, $startDateTime, $location, $payload) {

                $event = Event::findOrFail($examId);

                $event->title = 'Examen';
                $event->startDate = $startDateTime;
                $event->endDate = $startDateTime;
                $event->address = $location;
                $event->save();

                $payloads = $payload;

                $grades = [];
                $students = [];
                $studentIds = [];

                $event->payment->transactions()->delete();

                foreach ($payloads as $payload) {
                    $grades[$payload['grade_id']] = ['cost' => $payload['cost']];

                    foreach ($payload['students'] as $student) {



                        Transaction::create([
                            Transaction::PAYER_ID => $student['id'],
                            Transaction::COST => $payload['cost'],
                            Transaction::PAYMENT_ID => $event->payment->id,
                            Transaction::TRANSACTION_STATUS => TransactionStatus::UNPAID,
                        ]);

                        /* $pdfController->generateConvocation($student['id'], $event->id, $payload['cost'],  $payload['grade_id']);*/

                        $studentIds[] = $student['id'];

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


                ConvocationMailingProcess::dispatch($event->id, 'update');

            });

        }catch (QueryException | HttpSocketException | Exception $e ){
            Log::error($e->getMessage());
            Log::error($e->getLine());

        }
    }
}
