<?php

namespace App\Listeners;

use App\Events\AccountRequestConfirmed;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Mail\AccountConfirmationSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class AccountRequestConfirmedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AccountRequestConfirmed $event): void
    {

        try {


            $user = $event->user;
            Log::info($user);
            $username = "{$user->firstName}  {$user->lastName}";
            $email = $user->email;
            $password = $event->password;

            Mail::to($email)->send(new AccountConfirmationSent($username, $email, $password));
        }catch (Exception $exception){
            Log::error($exception->getMessage());
        }
        }
}
