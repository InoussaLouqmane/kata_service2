<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExamAttestationSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public $user,
        public String $filename,
        public String $gradeId
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('inoussalouqmane@gmail.com', 'Louqmane INOUSSA'),
            replyTo: [
                new Address($this->user->email, $this->user->firstName.' '.$this->user->lastName)
            ],
            subject: "Résultats de l'examen et envoi de votre bulletin",

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.examResultMail',
            with: [
                'user' => $this->user,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        Log::info(storage_path('app/public/bulletins/' . $this->filename));
        return [
            Attachment::fromPath(storage_path('app/public/bulletins/' . $this->filename))
                ->as('bulletin.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
