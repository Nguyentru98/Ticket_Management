<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketAssignee extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    public $userHandler;
    public $requester;
    public $recipientType;
    /**
     * Create a new message instance.
     */
    public function __construct($ticket,$userHandler,$requester,$recipientType)
    {
         // Lưu dữ liệu để truyền qua view
        $this->ticket = $ticket;
        $this->userHandler = $userHandler;
        $this->requester = $requester;
        $this->recipientType = $recipientType;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Yêu cầu hỗ trợ được Admin giao cho bạn !',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'mail.ticket_assignee',
    //     );
    // }
    public function build()
    {
        if ($this->recipientType === 'requester') {
            return $this->subject('Ticket của bạn đang được xử lý')
                        ->view('mail.ticket_requester');
        } elseif ($this->recipientType === 'userSuport') {
            return $this->subject('Bạn được phân công xử lý Ticket')
                        ->view('mail.ticket_assignee');
        }
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
