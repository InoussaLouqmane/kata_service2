<?php

namespace App\Jobs;

use App\Mail\ConvocationSent;
use App\Mail\FeesReceiptSent;
use App\Models\Event;
use App\Models\Transaction;
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

class ReceiptFeesProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected string $transaction_id;


    public function __construct($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        try{

            $transaction = Transaction::findOrFail($this->transaction_id);

            $user = User::findOrFail($transaction->payer_id);
            $pdf = Pdf::loadView('generatedPdf.FeesRecept', ['transaction_id' => $transaction->id]);

            $filename = 'facture_'.$user->firstName.time().'.pdf';


            Storage::put('public/facture/'.$filename, $pdf->output());

            $filePath = 'storage/facture/'.$filename;

            $transaction->bill = $filePath;
            $transaction->save();


            Mail::to($user->email)
                ->send(new FeesReceiptSent($user, $filename));

        }catch (ModelNotFoundException | QueryException | Exception $e){

            Log::error('Happened on Facture Job '.$e->getMessage());

        }
    }
}
