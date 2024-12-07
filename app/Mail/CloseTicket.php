<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CloseTicket extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    public $userSuport;
    public $requester;
    /**
     * Create a new message instance.
     */
    public function __construct($ticket,$userSuport,$requester)
    {
        $this->ticket = $ticket;
        $this->userSuport = $userSuport;
        $this->requester = $requester;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Ticket của bạn đã được xử lý',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'mail.closed_ticket',
    //     );
    // }
    public function build()
    {
        return $this->subject('Ticket của bạn đã được xử lý')
                    ->view('mail.closed_ticket');
        
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
