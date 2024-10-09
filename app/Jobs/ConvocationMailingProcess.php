<?php

namespace App\Jobs;

use App\Mail\ConvocationSent;
use App\Models\Event;
use App\Models\Exam;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Couchbase\QueryException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class ConvocationMailingProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected String $event_id;
    protected String $action;

    public function __construct($event_id, $action)
{
        if(is_array($event_id)) {
            Log::info('event_id is an array:'.json_encode($event_id));
        }else{
            $this->event_id = $event_id;
            $this->action = $action;
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{

            $event = Event::findOrFail($this->event_id);


            foreach ($event->examResults as $user) {

                $pdf = Pdf::loadView('generatedPdf.examconvocation', ['user_id' => $user->id, 'event_id' => $event->id]);

                $filename = 'convocation_'.$user->firstName.time().'.pdf';

                Storage::put('public/convocations/'.$filename, $pdf->output());

                $filePath = 'storage/convocations/'.$filename;
                $user->pivot->convocation = $filePath;
                $user->pivot->save();


                if($this->action == 'create'){

                    Mail::to($user->email)
                        ->send(new ConvocationSent($user, $filename, $user->pivot->grade_id));

                }elseif ($this->action == 'update'){
                    Mail::to($user->email)
                        ->send(new ConvocationSent($user, $filename, $user->pivot->grade_id));
                }
            }

        }catch (ModelNotFoundException | QueryException | Exception $e){

            Log::error('Happened on Convocation Job '.$e->getMessage());

        }



    }
}
