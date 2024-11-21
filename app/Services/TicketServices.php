<?php

namespace App\Services;

use App\Models\Ticket;

class TicketServices
{   
    // get list ticket
    public function getTicket()
    {
        return Ticket::all();
    }
    // create ticket
    public function createTicket($request)
    {
        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'department_id' => $request->department_id,
            'category_id' => $request->category_id,
            'priority' => $request->priority,
        ]);
    }
}
