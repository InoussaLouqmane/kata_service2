<?php

namespace App\Listeners;

use App\Events\AccountRequested;
use App\Mail\AccountRequestSent;
use App\Models\AccountRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Mockery\Exception;

class SendWaitingForConfirmationEmail implements ShouldQueue
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
    public function handle(AccountRequested $event): void
    {
        $email = $event->accountRequest->email;
        $username = $event->accountRequest->firstName;

        Mail::to($email)
            ->send(new AccountRequestSent($email, $username)
            );

        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/../../config/firebase_credentials.json');

        try {

        $messaging = $firebase->createMessaging();

        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => 'Vite, une nouvelle inscription!',
                "body" => "$username demande à s'inscrire"
            ],
            'topic' => 'AccountRequestPending'
        ]);

            $messaging->send($message);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
        }



    }
}
