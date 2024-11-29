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
    public function create(User $user): bool
    {
        return $user->roles()->whereIn('name', ['user', 'admin'])->exists();
    }

    public function delete(User $user, Ticket $ticket): bool
    {
        if ($user->role === 'admin' || $user->role === 'user') {
            return true;
        }

        // User chỉ có quyền xóa ticket của chính mình
        return $user->id === $ticket->user_id;
    }
}
