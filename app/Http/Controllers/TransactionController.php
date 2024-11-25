<?php

namespace App\Http\Controllers;

use App\Enums\TransactionStatus;
use App\Jobs\ReceiptFeesProcess;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Log;

use Kkiapay\Kkiapay;
use Mockery\Exception;

class TransactionController extends Controller
{

    public function verifyTransaction(Request $request)
    {

        $request->validate([
            'kkia_transaction_id' => 'required',
            'kata_transaction_id' => 'required',
        ]);


        $kkia_public_key = env('KKIAPAY_PUBLIC_KEY');
        $kkia_private_key = env('KKIAPAY_PRIVATE_KEY');
        $kkia_secret_key = env('KKIAPAY_SECRET_KEY');

        $kkiapay = new kkiapay($kkia_public_key, $kkia_private_key, $kkia_secret_key, sandbox: true);
        $verified = ($kkiapay->verifyTransaction($request->kkia_transaction_id));


        Log::info('Le contenu de la request ');
        try {
            if ($verified->status === 'SUCCESS') {

                $completedTransaction = Transaction::findOrFail($request->kata_transaction_id);
                $completedTransaction->update([
                    Transaction::TRANSACTION_STATUS => TransactionStatus::PAID,
                    Transaction::REFERENCE => $request->kkia_transaction_id,
                ]);


                ReceiptFeesProcess::dispatch($completedTransaction->id);



                return response()->json([
                    'success' => true,
                ], 200);

            } else {

                return response()->json([
                    'success' => false,
                ], 400);
            }
        } catch (Exception $e) {
            Log::error("Verifying transaction id: " . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

    }


}
