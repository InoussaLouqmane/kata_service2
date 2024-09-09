<?php

namespace App\Http\Controllers;

use App\Enums\TransferStatus;
use App\Models\Transfer;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransferController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'student_id' => 'required',
            'initiatingSensei_id' => 'required',
            'approvingSensei_id' => 'required',
            'motif' => "nullable"
        ]);

        try {

            $transfer = Transfer::create([
                Transfer::TRANSFER_STATUS => TransferStatus::PENDING,
                Transfer::INITIATING_SENSEI_ID => $request->initiatingSensei_id,
                Transfer::APPROVING_SENSEI_ID=> $request->approvingSensei_id,
                Transfer::STUDENT_ID => $request->student_id,
                Transfer::COMMENT => $request->motif
            ]);

            return response()->json([
                'transfer' => $transfer,
            ], 201);

        }catch (QueryException |Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],400);
        }

    }


    public function acceptTransfer($id){


        $transfer = Transfer::findOrFail($id);

        try{

            DB::transaction(function () use($transfer){
                $transfer->update([
                    Transfer::TRANSFER_STATUS => TransferStatus::APPROVED
                ]);

                $student = $transfer->Student;

                $student->clubs()->detach();
                $student->clubs()->attach($transfer->ApprovingSensei->clubs()->first()->id);


                return response()->json([
                    'transfer' => $transfer,
                ], 200);
            });

        }catch (QueryException |Exception $exception){
            return response()->json([
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
            ],400);
        }
    }

    public function refuseTransfer(Request $request, $id){

        $transfer = Transfer::findOrFail($id);

        try{

            if($request->comment){

                $transfer->update([
                    Transfer::TRANSFER_STATUS => TransferStatus::REJECTED,
                    Transfer::COMMENT => $request->comment
                ]);
            }else{
                $transfer->update([
                    Transfer::TRANSFER_STATUS => TransferStatus::REJECTED
                ]);
            }
            return response()->json([
                'transfer' => $transfer,
            ], 200);
        }catch (QueryException |Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],400);
        }
    }

    public function cancelTransfer(Request $request, $id){

        $transfer = Transfer::findOrFail($id);

        try{

            if($request->comment){

                $transfer->update([
                    Transfer::TRANSFER_STATUS => TransferStatus::CANCELLED,
                    Transfer::COMMENT => $request->comment
                ]);
            }else{
                $transfer->update([
                    Transfer::TRANSFER_STATUS => TransferStatus::CANCELLED
                ]);
            }
            return response()->json([
                'transfer' => $transfer,
            ], 200);
        }catch (QueryException |Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ],400);
        }
    }

}
