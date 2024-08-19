<?php

use App\Http\Controllers\AccountRequestController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\GradeController;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------
------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/login', [AuthController::class, 'login']);
Route::POST('/register', [UserRegisterController::class, 'store']);
Route::POST('/web-register', [UserRegisterController::class, 'storeWeb']);
Route::PATCH('/web-register', [UserRegisterController::class, 'update']);
Route::POST ('/ac-postulate', [AccountRequestController::class, 'store']);
Route::GET('/ac-list', [AccountRequestController::class, 'list']);
Route::POST ('/ac-validate', [AccountRequestController::class, 'validateAccountRequest']);
Route::POST ('/ac-reject', [AccountRequestController::class, 'rejectAccountRequest']);

Route::post ('/club-register', [ClubController::class, 'storeFromValidation']);
Route::post ('/club-register-form', [ClubController::class, 'store']);

Route::post ('/club-edit', [ClubController::class, 'updateClubInformation']);

Route::POST ('/discipline-register', [DisciplineController::class, 'store']);
Route::PUT ('/discipline-register', [DisciplineController::class, 'update']);
Route::DELETE ('/discipline-register', [DisciplineController::class, 'desactivateDiscipline']);
Route::PATCH ('/discipline-register', [DisciplineController::class, 'activateDiscipline']);

Route::POST ('/dojo-register', [DojoController::class, 'store']);
Route::PATCH ('/dojo-register', [DojoController::class, 'updateDojoInformations']);


Route::POST ('/grade', [GradeController::class, 'store']);
Route::PATCH ('/grade', [GradeController::class, 'update']);
Route::DELETE ('/grade', [GradeController::class, 'delete']);
