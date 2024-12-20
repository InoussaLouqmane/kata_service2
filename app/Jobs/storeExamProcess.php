<?php

namespace App\Jobs;

use App\Enums\ExamStatus;
use App\Enums\TransactionStatus;
use App\Http\Controllers\pdfController;
use App\Models\Event;
use App\Models\Exam;
use App\Models\Payment;
use App\Models\Transaction;
use HttpSocketException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class storeExamProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $startDateTime;
    protected $location;
    protected $payload;
    public function __construct(
        String $startDateTime,
        String $location,
        $payload)
    {
        $this->startDateTime = $startDateTime;
        $this->location = $location;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $startDateTime = $this->startDateTime;
        $location = $this->location;
        $payload = $this->payload;

        $pdfController = new pdfController();
        try{

            DB::transaction(function () use($startDateTime, $location, $payload) {

                $event = new Event();

                $event->title = 'Examen';
                $event->startDate = $startDateTime;
                $event->endDate = $startDateTime;
                $event->address = $location;
                $event->save();

                $exam = new Exam();
                $exam->event()->associate($event);
                $exam->examStatus = ExamStatus::INITIATED;
                $exam->save();


                $payloads = $payload;

                $grades = [];
                $students = [];
                $studentIds = [];

                $payment = Payment::create([
                    Payment::FEE_ID => 2,
                    Payment::EVENT_ID => $event->id,
                ]);

                foreach ($payloads as $payload) {
                    $grades[$payload['grade_id']] = ['cost' => $payload['cost']];

                    foreach ($payload['students'] as $student) {



                        Transaction::create([
                            Transaction::PAYER_ID => $student['id'],
                            Transaction::COST => $payload['cost'],
                            Transaction::PAYMENT_ID => $payment->id,
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

                $event->examResults()->attach($students);
                $event->grades()->attach($grades);


                ConvocationMailingProcess::dispatch($event->id, 'create');

            });

        }catch (QueryException | HttpSocketException | Exception $e ){
            Log::error($e->getMessage());
            Log::error($e->getLine());

        }
    }

}
