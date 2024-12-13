<?php

namespace App\Services;

use App\Mail\CloseTicket;
use App\Mail\NewTicket;
use App\Mail\TicketAssignee;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TicketServices
{
    // create ticket
    public function createTicket(Request $request)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'required|nullable|string',
            'department_id'=>'required',
            'category_id'=>'required',
            'user_id'=>'required',
            'priority'=>'nullable',
            'assigned_to'=> 'nullable',
        ]);
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'priority' => $request->priority,
            'status' => 0,
        ]);
        $user = User::find($request->user_id);
        // Mail::to('trunv98@gmail.com')->send(new NewTicket($ticket,$user));

        return response()->json(['message' => 'Ticket đã được tạo và thông báo đã được gửi.'], 200);
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
        $userHandler = User::find($request->assigned_to);
        $requester = User::find($ticket->user_id);
        // Mail::to($userHandler->email)->send(new TicketAssignee($ticket,$userHandler,$requester,"userSuport"));
        // Mail::to($requester->email)->send(new TicketAssignee($ticket,$userHandler,$requester,"requester"));

        return response()->json(['message' => 'Ticket assigned successfully']);
    }

    public function getAllTickets()
    {
        return Ticket::with(['department', 'user', 'category', 'assignedTo'])->paginate(5); 
    }
    public function getUserTickets($userId)
    {
        return Ticket::with(['department', 'user', 'category', 'assignedTo'])->where('user_id', $userId)->orWhere('assigned_to',$userId)->paginate(5);
    }
    public function deleteTicket($idTicket)
    {
        $ticket = Ticket::find($idTicket);
        return  $ticket->delete();
    }
    public function findById($idTicket)
    {
        $ticket = Ticket::find($idTicket);
        return $ticket;
    }
    public function updateStatus(Request $request) {
        $ticket = Ticket::find($request->id);
        $request->validate([
            'id' => 'required|exists:tickets,id',
            'status' => 'required|integer',
        ]);
        if (!$ticket) {
            return response()->json([
                'message' => 'Ticket not found'
            ], 404);
        }
        $ticket->update([
            'status' => $request->status
        ]);
        if ($ticket->status == 3) {
            $ticket = Ticket::find($request->id);
            $userSuport = User::find($ticket->assigned_to);
            $requester = User::find($ticket->user_id);
            // Mail::to($requester->email)->send(new CloseTicket($ticket,$userSuport,$requester));
        }

        return response()->json([
            'message' => 'Status updated successfully',
            'ticket' => $ticket
        ]);
    }
    public function updateTicket($request)
    {
        $ticket = Ticket::find($request->id);
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'department_id'=>'required',
            'category_id'=>'required',
            'user_id'=>'required',
            'priority'=>'nullable',
            'assigned_to'=> 'nullable',
        ]);
        $ticket->update($validatedData);
        return  response()->json(['message' => 'Ticket update successfully']);
    }
}
