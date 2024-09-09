<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class AuthController extends Controller
{
    public function index()
    {
        return view('authentication.login');
    }



    public function loginWeb(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        try {
            if (Auth::attempt($credentials, $remember)) {


                $user = Auth::user();
                if ($user->first_attempt == 1) {
                    return redirect()->intended(route('authentication.reset-password', [Auth::user()->id]));
                }else{

                    if($user->role == Role::ADMIN->value){
                        return redirect()->intended(route('main.adminDashboard'));
                    }elseif ($user->role == Role::SENSEI->value){
                        return redirect()->intended(route('main.teacherDashboard'));
                    }elseif ($user->role == Role::STUDENT->value){
                        return redirect()->intended(route('main.studentDashboard'));
                    }
                }



            }else{
                Log::info('Something while login went wrong');
            }
        }catch (Exception $exception){
            Log::error($exception->getMessage());
        }


        $validator['emailPassword'] = "Identifiants incorrects";
        return redirect(route('authentication.login',))->withErrors($validator);
    }


    public function resetPasswordWeb(Request $request)
    {

        $id = $request->input('userId');
        $password = $request->input('password');
        $confirmPassword = $request->input('confirm-password');
        $user = User::where('id', $id)->first();

        try{


            if ($password === $confirmPassword) {


                $user->password = Hash::make($password);
                $user->first_attempt = 0;
                $user->save();


                if($user->role == Role::ADMIN->value){
                    return redirect()->intended(route('main.adminDashboard'));
                }elseif ($user->role == Role::SENSEI->value){
                    return redirect()->intended(route('main.teacherDashboard'));
                }elseif ($user->role == Role::STUDENT->value){
                    return redirect()->intended(route('main.studentDashboard'));
                }
            }else{

                $validator['passwordDiff'] = "Les mots de passe ne sont pas identiques.";
                return redirect(route('authentication.reset-password', [Auth::user()->id]))->withErrors($validator);
            }

        }catch (Exception $e){
            Log::info("Quelque chose s'est mal passé : {$e->getMessage()}");
            return redirect()->back();
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "The provided credentials are incorrect"
            ], 401);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
            'message' => "logged successfully"
        ], 200);

    }

    public function logout(Request $request)
    {
        $user = $request->input(User::ID);
        $request->user()->tokens()->delete();

    }
    public function logoutWeb(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('authentication.login');
    }

}
