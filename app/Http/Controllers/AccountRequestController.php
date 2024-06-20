<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Events\AccountRequested;
use App\Mail\AccountRequestSent;
use App\Models\AccountRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class AccountRequestController extends Controller
{
    public function store(Request $request)
    {

        /*$request->validate([
                AccountRequest::LAST_NAME => ['required', 'string'],
                AccountRequest::PHONE => ['string', 'nullable'],
                AccountRequest::GENRE => ['nullable', 'string'],
                AccountRequest::EMAIL => ['required', 'string'],
                AccountRequest::FIRST_NAME => ['required', 'string'],
                AccountRequest::MARTIAL_ART_TYPE => ['required', 'string'],
                AccountRequest::LICENSE_ID => ['string', 'nullable'],
                AccountRequest::GRADE => ['required', 'string'],
                AccountRequest::CLUB_NAME => ['required', 'string'],
                AccountRequest::COMMENT => ['string', 'nullable'],
                AccountRequest::CLUB_EMAIL => ['string', 'nullable'],
                AccountRequest::USER_ID => ['string', 'nullable'],
            ]
        );*/


        try {
            $accountRegistered = AccountRequest::create([
                AccountRequest::FIRST_NAME => $request->input(AccountRequest::FIRST_NAME),
                AccountRequest::LAST_NAME => $request->input(AccountRequest::LAST_NAME),
                AccountRequest::PHONE => $request->input(AccountRequest::PHONE),
                AccountRequest::GENRE => $request->input(AccountRequest::GENRE),
                AccountRequest::EMAIL => $request->input(AccountRequest::EMAIL),
                AccountRequest::LICENSE_ID => $request->input(AccountRequest::LICENSE_ID),
                AccountRequest::MARTIAL_ART_TYPE => $request->input(AccountRequest::MARTIAL_ART_TYPE),
                AccountRequest::GRADE => $request->input(AccountRequest::GRADE),
                AccountRequest::CLUB_NAME => $request->input(AccountRequest::CLUB_NAME),
                AccountRequest::CLUB_EMAIL => $request->input(AccountRequest::CLUB_EMAIL),
                AccountRequest::CLUB_ADDRESS => $request->input(AccountRequest::CLUB_ADDRESS),
                AccountRequest::STATUS => RequestStatus::PENDING,
                AccountRequest::COMMENT => $request->input(AccountRequest::COMMENT),
                AccountRequest::USER_ID => $request->input(AccountRequest::USER_ID),
                AccountRequest::ROLE => $request->input(AccountRequest::ROLE),
            ]);

            event(new AccountRequested($accountRegistered));

            return response()->json([
                "message" => "Sent Successfully",
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e
            ], 403);
        }
    }

    public function list(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $accountRequest = AccountRequest::paginate($perPage);
        return response()->json([
            'data' => $accountRequest
        ], 200);
    }

    public function show($id)
    {
        try {
            $accountRequest = AccountRequest::findOrFail($id);

            return response()->json([
                'data' => $accountRequest
            ], 200);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'error' => 'Aucun résultat trouvé',
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception,
            ], 404);
        }
    }


    public function validateAccountRequest($id)
    {
        try {
            $accountRequest = $this->show($id);
            $accountRequest->status = RequestStatus::APPROVED;

            $user = User::class;

            $user->

            $accountRequest->save();
            return response()->json([
                'message' => "Approved Successfully"
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception
            ], 401);
        }
    }

    public function rejectAccountRequest($id)
    {
        try {
            $accountRequest = $this->show($id);
            $accountRequest->status = RequestStatus::REJECTED;
            $accountRequest->save();

            return response()->json([
                'message' => "Rejected Successfully"
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception
            ], 401);
        }

    }
}
