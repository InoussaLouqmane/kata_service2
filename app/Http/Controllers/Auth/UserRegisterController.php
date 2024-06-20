<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Genre;
use App\Enums\MartialArtType;
use App\Enums\Role;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;



class UserRegisterController extends Controller
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
            $user = User::create([
                User::EMAIL => $request->email,
                User::PASSWORD => Hash::make($request->password),
                User::STATUS => UserStatus::ACTIVE,
                User::FIRST_NAME =>  $request->firstName,
                User::LAST_NAME => $request->lastName,
                User::PHONE => $request->phone,
                User::GENRE => Genre::MALE,
                User::PHOTO_PATH => $request->photoPath,
                User::BIO_DESCRIPTION => $request->bioDescription,
                User::ROLE => Role::ADMIN,
                User::MARTIAL_ART_TYPE => MartialArtType::KARATE,
                User::LICENSE_ID => $request->licenseId,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return response([
                "message" => "Registered Successfully",
                "user" => $user,
            ], 201);
        }
        catch (Exception $e){
            return response(['message' => $e->getMessage()], 400);
        }

    }
}

