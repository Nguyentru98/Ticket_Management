<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;

class TicketPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, Ticket $ticket): bool
    {
        // Kiểm tra vai trò admin thông qua quan hệ
        if ($user->roles->contains('name', 'admin')) {
            return true;
        }

        // User chỉ được xem ticket của chính mình
        return $user->id === $ticket->user_id;
    }
}
