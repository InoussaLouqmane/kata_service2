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

class ConvocationSent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public User $user,
        public String $filename
    )
    {

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from : new Address('inoussalouqmane@gmail.com', 'Louqmane INOUSSA'),
            replyTo: [
              new Address($this->user->email, $this->user->firstName.' '.$this->user->lastName)
            ],
            subject: 'Convocation à l\'examen',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.convocationMailView',
            with: [
                'user' => $this->user,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        Log::info(storage_path('app/public/convocations/' . $this->filename));
        return [
            Attachment::fromPath(storage_path('app/public/convocations/' . $this->filename))
            ->as('convocation.pdf')
            ->withMime('application/pdf'),
        ];
    }
}
