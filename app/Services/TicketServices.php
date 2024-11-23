<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketServices
{
    // get list ticket
    public function getTicket()
    {
        $tickets = Ticket::with(['department', 'user', 'category','assignedTo'])->get();;
        return $tickets;
    }
    public function createTicket(Request $request)
    {
        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'priority' => $request->priority,
        ]);
    }
}
