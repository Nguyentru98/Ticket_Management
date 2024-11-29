<?php

namespace App\Services;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketServices
{
    // get list ticket
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
    // assignTo 
    public function assignTo(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $ticket = Ticket::find($request->ticket_id);
        $ticket->update(['assigned_to' => $request->assigned_to]);

        return response()->json(['message' => 'Ticket assigned successfully']);
    }

    public function getAllTickets()
    {
        return Ticket::with(['department', 'user', 'category', 'assignedTo'])->get(); // Load thêm quan hệ nếu cần
    }
    public function getUserTickets($userId)
    {

        return Ticket::with(['department', 'user', 'category', 'assignedTo'])->where('user_id', $userId)->orWhere('assigned_to',$userId)->get();
    }
}
