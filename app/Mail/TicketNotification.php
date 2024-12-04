<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $user;
    

    /**
     * Create a new message instance.
     */
    public function __construct($ticket,$user)
    
    {
        $this->ticket = $ticket;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Yêu cầu hỗ trợ từ người dùng',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        // Lấy email người dùng đăng nhập
        $userEmail = auth()->user()->email;

        return $this->from($userEmail) // Email người gửi
                    ->subject('Thông báo Ticket mới')
                    ->view('sendMailTicket');
                    
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
