<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class mailAssignTo extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    public $userHandler;
    public $requester;
    /**
     * Create a new message instance.
     */
    public function __construct($ticket,$userHandler,$requester)
    {
         // Lưu dữ liệu để truyền qua view
        $this->ticket = $ticket;
        $this->userHandler = $userHandler;
        $this->requester = $requester;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Yêu cầu hỗ trợ được Admin giao cho bạn !',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mailAssignTo',
        );
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
