<?php

use App\Http\Controllers\AccountRequestController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExamControllerWeb;
use App\Http\Controllers\feesController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GradeControllerApi;
use App\Http\Controllers\ResourceApiController;
use App\Http\Controllers\ResourceWebController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Models\Discipline;
use App\Models\Resource;
use App\Models\User;
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

Route::POST('/password-reset', [AuthController::class, 'resetPasswordApi']);

Route::POST ('/ac-postulate', [AccountRequestController::class, 'store']);
Route::GET('/ac-list', [AccountRequestController::class, 'list']);
Route::POST ('/ac-validate', [AccountRequestController::class, 'validateAccountRequest']);
Route::POST ('/ac-reject', [AccountRequestController::class, 'rejectAccountRequest']);

Route::post ('/club-register', [ClubController::class, 'storeFromValidation']);
Route::post ('/club-register-form', [ClubController::class, 'store']);

Route::post ('/club-edit', [ClubController::class, 'updateClubInformation']);

Route::GET('/discipline/all', [DisciplineController::class, 'list']);
Route::POST ('/discipline-register', [DisciplineController::class, 'store']);
Route::PUT ('/discipline-register', [DisciplineController::class, 'update']);
Route::DELETE ('/discipline-register', [DisciplineController::class, 'desactivateDiscipline']);
Route::PATCH ('/discipline-register', [DisciplineController::class, 'activateDiscipline']);

Route::POST ('/dojo-register', [DojoController::class, 'store']);
Route::PATCH ('/dojo-register', [DojoController::class, 'updateDojoInformations']);


Route::POST ('/grade', [GradeController::class, 'store']);
Route::PATCH ('/grade', [GradeController::class, 'update']);
Route::DELETE ('/grade', [GradeController::class, 'delete']);

Route::GET('/event/', [EventController::class, 'indexApi']);
Route::GET('/event/show/{id}', [EventController::class, 'show']);
Route::POST('/event/create', [EventController::class, 'storeEventApi']);
Route::PATCH('/event/update/{id}', [EventController::class, 'updateApi']);
Route::DELETE('/event/delete/{id}', [EventController::class, 'deleteApi']);

Route::POST('/exams/create', [ExamControllerWeb::class, 'store']);
Route::PATCH('/exams/update/{id}', [ExamControllerWeb::class, 'update']);
Route::POST('/exams/delete', [ExamControllerWeb::class, 'deleteSomeone']);
Route::POST('/exams/close/{id}', [ExamControllerWeb::class, 'archiveExam']);
Route::PATCH('/exams/add-student', [ExamControllerWeb::class, 'addSomeOne']);
Route::PATCH('/exams/end-exam', [ExamControllerWeb::class, 'endExam']);
Route::PATCH('/exams/update-student', [ExamControllerWeb::class, 'updateSomeone']);


Route::GET('/grades', [GradeControllerApi::class, 'index']);


Route::POST('/resources/create', [ResourceApiController::class, 'store']);
Route::PATCH('/resources/update/{id}', [ResourceApiController::class, 'update']);
Route::DELETE('/resources/delete/{id}', [ResourceApiController::class, 'delete']);

Route::POST('transfer/create', [TransferController::class, 'store']);
Route::PATCH('transfer/accept/{id}', [TransferController::class, 'acceptTransfer']);
Route::PATCH('transfer/reject/{id}', [TransferController::class, 'refuseTransfer']);
Route::PATCH('transfer/cancel/{id}', [TransferController::class, 'cancelTransfer']);

Route::GET('user/{id}', [UserRegisterController::class , 'showCurrentUser']);


Route::GET('/fees', [feesController::class,'list']);
Route::GET('/fees/{id}', [feesController::class,'show']);
Route::POST('/fees/create', [feesController::class,'store']);
Route::PATCH('/fees/update/{id}', [feesController::class,'update']);
Route::DELETE('/fees/delete/{id}', [feesController::class,'delete']);

Route::POST('/transactions/verify', [TransactionController::class, 'verifyTransaction']);
