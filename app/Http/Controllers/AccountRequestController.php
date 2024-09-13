<?php

namespace App\Http\Controllers;

use App\Enums\RequestStatus;
use App\Events\AccountRequestConfirmed;
use App\Events\AccountRequested;

use App\Http\Controllers\Auth\UserRegisterController;
use App\Models\AccountRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
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
            $checker = AccountRequest::where('email', $request->input('email'))->first();
            if ($checker != null && ($checker->status == 'Pending' || $checker->status == 'Approuvé') ) {
                return response()->json([
                    'message' => 'Adresse mail déjà utilisée',
                ], 403);
            }
            $genre = ($request->genre == 0) ? 'Femme' : 'Homme';
            $accountRegistered = AccountRequest::create([
                AccountRequest::FIRST_NAME => $request->input(AccountRequest::FIRST_NAME),
                AccountRequest::LAST_NAME => $request->input(AccountRequest::LAST_NAME),
                AccountRequest::PHONE => $request->input(AccountRequest::PHONE),
                AccountRequest::GENRE => $genre,
                AccountRequest::EMAIL => strtolower($request->email),
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
        } catch (Exception | QueryException $e ) {
            return response()->json([
                'message' => "L'envoi à eu un pépin $e"
            ], 403);
        }
    }

    public function list(Request $request)
    {
        try{

            $perPage = $request->input('per_page', 20);
            $accountRequest = AccountRequest::paginate($perPage);
            $accountRequest = AccountRequest::orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'data' => $accountRequest
            ], 200);

        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'message' => $e->getMessage()
            ]);
    }

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
            Log::error($exception->getMessage());
            return response()->json([
                'error' => 'Une erreur s\'est produite lors de la récupération de la demande de compte',
            ], 500);
        }
    }



    public function validateAccountRequest(Request $request)
    {

        $id = $request->input('requestID');
        $userController = new UserRegisterController();
        try {
            $accountRequest = AccountRequest::findOrFail($id);
            $accountRequest->status = RequestStatus::APPROVED;
            $accountRequest->save();

            $userController->storeUserFromValidation($id, $request);

            return redirect()->back()->with('success', 'Validation réussie et utilisateur créé');

        } catch (Exception $exception) {
            Log::error("Validate request fucntion : $exception");
            return redirect()->back()->with('fail', "Oops, une erreur s'est produite");
        }
    }

    public function rejectAccountRequest(Request $request)
    {
        $id = $request->input('requestID');
        $comment = $request->input('comment');
        try {
            $accountRequest = AccountRequest::where('id', $id)->first();
            $accountRequest->status = RequestStatus::REJECTED;
            $accountRequest->comment = $comment;
            $accountRequest->save();

            return redirect()->back()->with('success', "Tout s'est bien produit");

            /*return response()->json([
                'message' => "Rejected Successfully"
            ], 200);*/
        } catch (Exception $exception) {
            Log::info($exception);
            return redirect()->back()->with('success', "Oops, une erreur produite");
           /* return response()->json([
                'error' => $exception
            ], 401);*/
        }

    }
}
