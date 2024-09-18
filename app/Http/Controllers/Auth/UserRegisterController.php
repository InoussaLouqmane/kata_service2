<?php

namespace App\Http\Controllers\Auth;

use App\Enums\MartialArtType;
use App\Enums\UserStatus;
use App\Events\AccountRequestConfirmed;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\Controller;
use App\Models\AccountRequest;
use App\Models\Club;
use App\Models\Discipline;
use App\Models\User;
use http\Env\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Exception;



class UserRegisterController extends Controller implements ShouldQueue
{

    public function showCurrentUser($id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user,
        ],200);
    }

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
                User::LICENSE_ID => $request->licenseId,
                User::GRADE=>  $request->grade,
            ]);

            event(new Registered($user));
            event(new AccountRequestConfirmed($user, $password));

            if($request->grade)
                $user->grades()->attach($request->grade);
            $user->save();


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
                User::BIO_DESCRIPTION => $request->bioDescription,
                User::ROLE => $request->role,

                User::LICENSE_ID => $request->licenseId,
                User::GRADE=>  $request->grade,
            ]);


            if ($request->has('photoPath')) {
                $path = $request->file('photoPath')->store('images', 'public');
                $user->photoPath = $path;
            }

            if($request->club_id) {
                Log::info('Here is '.$request->club_id);
                $user->clubs()->attach($request->club_id);
            }else{
                Log::info('No club id '. $request->all());
            }


            if($request->grade)
                $user->grades()->attach($request->grade);

            $user->save();


            event(new AccountRequestConfirmed($user, $password));

            return redirect()->route('main.student.students')->with('success', "L'utilisateur a été créé avec succès");
        }
        catch (QueryException|\Mockery\Exception $e){
            Log::info('QueryExcept  : '.$e);
            return redirect()->back()->with('fail', "Oops, une erreur s'est produite ! $e");
        }

    }

    public function update(Request $request)
    {
        $id = $request->id;
        // Validation des données
        $request->validate([
            User::FIRST_NAME => ['required', 'string'],
            User::LAST_NAME => ['required', 'string'],
            User::EMAIL => ['required', 'email'],
            // Ajoute des validations supplémentaires si nécessaire
        ]);

        try {
            // Récupère l'utilisateur par ID
            $user = User::findOrFail($id);

            // Mise à jour des informations de l'utilisateur
            $user->update([
                User::FIRST_NAME => $request->firstName,
                User::LAST_NAME => $request->lastName,
                User::EMAIL => $request->email,
                User::PHONE => $request->phone,
                User::GENRE => $request->genre,
                User::BIO_DESCRIPTION => $request->bioDescription,
                User::ROLE => $request->role,
                User::LICENSE_ID => $request->licenseId,
                User::GRADE => $request->grade,
            ]);



            // Gestion de l'upload de la photo
            if ($request->has('photoPath')) {
                $path = $request->file('photoPath')->store('images', 'public');
                $user->photoPath = $path;
            }

            // Mise à jour des associations
            if ($request->has('club_id')) {
                $user->clubs()->sync([$request->club_id]); // Utilisation de sync pour éviter les doublons
            }

            if ($request->has('grade')) {
                $user->grades()->sync([$request->grade]); // Utilisation de sync pour éviter les doublons
            }

            // Sauvegarde des modifications
            $user->save();

            Log::info('User updated data : ' . $request);


            return redirect()->back()->with('success', "L'utilisateur a été mis à jour avec succès");
        } catch (QueryException|\Mockery\Exception $e) {
            Log::info('QueryExcept  : ' . $e);
            return redirect()->back()->with('fail', "Oops, une erreur s'est produite ! $e");
        }
    }



    public function storeUserFromValidation($id) {


            $request = AccountRequest::where('id', $id)->first();

            try
            {
                DB::transaction(function () use ($request) {


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
                        User::LICENSE_ID => $request->licenseId,
                        User::GRADE=>  $request->grade,

                    ]);

                    $request->user_id = $user->id;
                    $request->save();
                    $clubController = new ClubController();
                    $request->club_id = $clubController->storeFromWebValidation($request);

                    if($request->grade)
                        $user->grades()->attach($request->grade);


                    if($request->club_id){

                        Log::info('Oui, il y a un club id');
                        $user->clubs()->attach($request->club_id);

                    } else {

                        Log::info('NOn, pas de un club id : '.$request->all());

                        $request->user_id = $user->id;

                    }

                    $request->save();
                    event(new AccountRequestConfirmed($user, $password));

                    return response([
                        "message" => "Registered Successfully",
                        "user" => $user,
                    ], 201);
                });


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

