<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use GPBMetadata\Google\Api\Log;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class feesController extends Controller
{
    public function list(){
        $fees = Fees::all();
        return response()->json([
            'fees'=>$fees], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'cost'=>'required',
            'club_id'=>'required',
            'frequency'=>'required',
        ]);

        try{
            $fees = Fees::create([
                'name' =>  $request->name,
                'cost' =>  $request->cost,
                'club_id' =>  $request->club_id,
                'frequency' =>  $request->frequency,
                Fees::LAST_CHARGED_AT => now()
            ]);
           return response()->json([
               'success'=>true,
               'fees' =>$fees
           ], 201);
        }catch (\Exception | QueryException $exception){
            return response()->json([
                'success'=>false,
            ], 400);
        }
    }


    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'cost'=>'required',
            'club_id'=>'required',
            'frequency'=>'required',
        ]);

        $fees = Fees::findOrFail($id);

        try {
            $fees->update([
                'name'=> $request->name,
                'cost'=> $request->cost,
                'club_id'=> $request->club_id,
                'frequency'=> $request->frequency,
            ]);

            return response()->json([
                'success'=>true,
            ], 200);

        }catch (\Exception | QueryException $exception){
            \Illuminate\Support\Facades\Log::info($exception->getMessage());
            return response()->json([
                'message'=>$exception->getMessage(),
            ],400);
        }
    }

    public function delete($id){
        $fee = Fees::findOrFail($id);

        try {
            $fee->delete();
            return response()->json([
                'success'=>true,
            ],200);
        }catch (\Exception | QueryException $exception){
            return response()->json([
                'success'=>false,
            ], 400);
        }


    }

    public function show($id){

        try {
            $fee = Fees::findOrFail($id);
            return response()->json([
                'fee'=>$fee,
            ], 200);
        }catch (\Exception | QueryException $exception){
            return response()->json([
                'success'=>false,
            ], 400);
        }
    }

    public function getPayments($userId)
    {
        $user = User::findOrFail($userId);
        $user_club = $user->clubs()->first()->id;

        if ($user_club) {
            $fees = Fees::where('club_id', $user_club)->get();

            $response = [];

            foreach ($fees as $fee) {
                $payments = Payment::where('fee_id', $fee->id)->get();

                $response[] = [
                    'fee_id' => $fee->id,
                    'fee_name' => $fee->name,
                    'amount' => $fee->amount,
                    'payments' => $payments, // Laravel va automatiquement convertir en JSON
                ];
            }

            return response()->json($response);
        }

        return response()->json(['error' => 'No fees found'], 404);
    }

    public function getTransactions($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);


        if ($payment) {
            $transactions = Transaction::where('payment_id', $paymentId)->get();


            $response = [];



                $response[] = [
                    'payment_id' => $payment->id,
                    'date' => $payment->created_at,
                    'transactions' => $transactions, // Laravel va automatiquement convertir en JSON
                ];


            return response()->json($response);
        }

        return response()->json(['error' => 'No fees found'], 404);
    }

}
