<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Genre;
use App\Enums\MartialArtType;
use App\Enums\Role;
use App\Enums\UserStatus;
use App\Events\AccountRequestConfirmed;
use App\Http\Controllers\Controller;
use App\Models\AccountRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Exception;



class UserRegisterController extends Controller implements ShouldQueue
{


    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            User::FIRST_NAME => ['required', 'string'],
            User::LAST_NAME => ['required', 'string'],
            User::EMAIL => ['required', 'email'],
            User::PASSWORD=> ['required', 'string'],
        ]);



        try{
            $password = Str::password(8);
            $user = User::create([

                User::FIRST_ATTEMPT => 1,
                User::EMAIL => $request->email,
                User::PASSWORD => Hash::make($password),
                User::STATUS => UserStatus::ACTIVE,
                User::FIRST_NAME =>  $request->firstName,
                User::LAST_NAME => $request->lastName,
                User::PHONE => $request->phone,
                User::GENRE => $request->genre,
                User::PHOTO_PATH => $request->photoPath,
                User::BIO_DESCRIPTION => $request->bioDescription,
                User::ROLE => $request->role,
                User::MARTIAL_ART_TYPE => $request->martialArtType,
                User::LICENSE_ID => $request->licenseId,
            ]);

            event(new Registered($user));
            event(new AccountRequestConfirmed($user, $password));

            return response([
                "message" => "Registered Successfully",
                "user" => $user,
            ], 201);
        }
        catch (Exception $e){
            return response(['message' => $e->getMessage()], 400);
        }

    }

    public function storeWeb(Request $request)
    {
        $request->validate([
            User::FIRST_NAME => ['required', 'string'],
            User::LAST_NAME => ['required', 'string'],
            User::EMAIL => ['required', 'email'],
            User::PASSWORD=> ['required', 'string'],
        ]);



        try{
            $password = Str::password(8);
            $user = User::create([

                User::FIRST_ATTEMPT => 1,
                User::EMAIL => $request->email,
                User::PASSWORD => Hash::make($password),
                User::STATUS => UserStatus::ACTIVE,
                User::FIRST_NAME =>  $request->firstName,
                User::LAST_NAME => $request->lastName,
                User::PHONE => $request->phone,
                User::GENRE => $request->genre,
                User::PHOTO_PATH => $request->photoPath,
                User::BIO_DESCRIPTION => $request->bioDescription,
                User::ROLE => $request->role,
                User::MARTIAL_ART_TYPE => $request->martialArtType,
                User::LICENSE_ID => $request->licenseId,
            ]);

            event(new Registered($user));
            event(new AccountRequestConfirmed($user, $password));

            return redirect()->back()->with('success', "L'utilisateur a été créé avec succès");
        }
        catch (Exception $e){
            return redirect()->back()->with('fail', "Oops, une erreur s'est produite ! $e");
        }

    }


    public function storeUserFromValidation($id){


            $request = AccountRequest::where('id', $id)->first();

            Log::info($request->get());

            try
            {
                $password = Str::password(10);
                $user = User::create([
                    User::EMAIL => $request->email,
                    User::PASSWORD => Hash::make($password),
                    User::STATUS => UserStatus::ACTIVE,
                    User::FIRST_NAME =>  $request->firstName,
                    User::LAST_NAME => $request->lastName,
                    User::PHONE => $request->phone,
                    User::GENRE => $request->genre ?? null,
                    User::PHOTO_PATH => $request->photoPath ?? null,
                    User::BIO_DESCRIPTION => $request->bioDescription ?? null,
                    User::ROLE => $request->role,
                    User::MARTIAL_ART_TYPE => $request->martialArtType,
                    User::LICENSE_ID => $request->licenseId,
                ]);


                event(new AccountRequestConfirmed($user, $password));
                return response([
                    "message" => "Registered Successfully",
                    "user" => $user,
                ], 201);
            }
            catch (Exception $e){
                Log::info("Store From USer function : {$e->getMessage()}");
                return response(['message' => $e->getMessage()], 400);
            }
        }

        public function ActivateAccountWeb(Request $request)
        {
            try{

            $user = User::where('id', $request->id)->first();

            $user->status = UserStatus::ACTIVE;
            $user->save();
            return redirect()->back()->with('success', 'Le compte a bien été activé');
            }catch (\Mockery\Exception $exception){
                Log::info($exception->getMessage());
                return redirect()->back()->with('fail', 'Oops, une erreur s\'est produite');
            }
        }

    public function DesactivateAccountWeb(Request $request)
    {
        try{
            $user = User::where('id', $request->id)->first();
            $user->status = UserStatus::INACTIVE;
            $user->save();
            return redirect()->back()->with('success', 'Le compte a bien été désactivé');
        }catch (\Mockery\Exception $exception){
            Log::info($exception->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur s\'est produite');
        }
    }

    public function ReinitialisationPassword(Request $request){
        try{

            $password = Str::password(8);
            $user = User::where('id', $request->id)->first();
            $user->password = $password;
            $user->first_attempt = 1;
            $user->save();

            event(new AccountRequestConfirmed($user, $password));
            return redirect()->back()->with('success', 'Tout s\'est bien produit');

        }catch (\Mockery\Exception $exception){
            Log::info($exception->getMessage());
            return redirect()->back()->with('fail', 'Oops, une erreur s\'est produite');
        }
    }
}

