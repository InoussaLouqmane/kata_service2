<?php

namespace App\Http\Controllers;

use App\Models\Fees;
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
}
