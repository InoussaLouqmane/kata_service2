<?php

namespace App\Jobs;

use App\Enums\PaymentStatus;
use App\Enums\TransactionStatus;
use App\Enums\Role;
use App\Models\Club;
use App\Models\Fees;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\JsonResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddFeesPayments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $fee;

    public function __construct(
        Fees $fee,
    )
    {
        $this->fee = $fee;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $fee = $this->fee;

        $students = User::where('role', Role::STUDENT)
            ->whereHas('clubs', function ($query) use ($fee) {
                $query->where('club_id', $fee->club_id);
            })
            ->get();

        try {

            DB::transaction(function () use ($students, $fee) {

                $payment = Payment::create([
                    Payment::FEE_ID => $fee->id,
                ]);

                foreach ($students as $student) {

                    Transaction::create([
                        Transaction::PAYMENT_ID => $payment->id,
                        Transaction::PAYER_ID => $student->id,
                    ]);

                }

                $fee->last_charged_at = now();
                $fee->save();

            });


        } catch (\Exception|QueryException $exception) {

            Log::error($exception->getMessage());
            Log::info($exception->getLine());
        }
    }
}
