<?php

namespace App\Jobs;

use App\Mail\ConvocationSent;
use App\Mail\ExamAttestationSent;
use App\Models\Event;
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

class BulletinMailingProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected string $event_id;
    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{

            $event = Event::findOrFail($this->event_id);


            foreach ($event->examResults as $user) {

                $pdf = Pdf::loadView('generatedPdf.exambulletin', ['user_id' => $user->id, 'event_id' => $event->id]);

                $filename = 'bulletin_'.$user->firstName.time().'.pdf';

                Storage::put('public/bulletins/'.$filename, $pdf->output());

                $filePath = 'storage/bulletins/'.$filename;
                $user->pivot->bulletin = $filePath;
                $user->pivot->save();


                Mail::to($user->email)
                    ->send(new ExamAttestationSent($user, $filename, $user->pivot->grade_id));
            }

        }catch (ModelNotFoundException | QueryException | Exception $e){

            Log::error('Happened on Bulletin Job '.$e->getMessage());

        }
    }
}
