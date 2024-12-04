<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Services\TicketServices;
use App\Http\Requests\FormDataRequest;

class TicketController extends Controller
{
    protected TicketServices $ticketServices;

    public function __construct(
        TicketServices $ticketServices
    ) {
        $this->ticketServices = $ticketServices;
    }
    //list ticket
    // public function getTicket() {
    //     $dataList  = $this->ticketServices->getTicket();
    //     return response()->json($dataList);
    // }
    public function getTicket()
    {
        // Lấy user đang đăng nhập
        $user = auth()->user();

        // Kiểm tra vai trò của user
        if ($user->roles->contains('name', 'admin')) {
            // Admin xem tất cả ticket
            $dataList = $this->ticketServices->getAllTickets();
        } else {
            // User chỉ xem ticket của chính mình
            $dataList = $this->ticketServices->getUserTickets($user->id);
        }

        return response()->json($dataList);
    }
    // create ticket
    public function createTicket(FormDataRequest $request)
    {
        $this->authorize('create', Ticket::class); // Kiểm tra quyền qua Policy

        $this->ticketServices->createTicket($request);
    
        return response()->json(['message' => 'Ticket created successfully'], 201);
    }
    // assignTo
    public function assignTo(Request $request)
    {
        $this->ticketServices->assignTo($request);
        return response()->json(['message' => 'Ticket updated successfully controller']);
    }
    // delete ticket
    public function deleteTicket($idTicket) {
        $this->ticketServices->deleteTicket($idTicket);
    }
    // delete ticket
    public function updateTicket(Request $request) {
        $this->ticketServices->updateTicket($request);
    }
    // find by id ticket
    public function findById($idTicket) {
        $ticket = $this->ticketServices->findById($idTicket);
        return  $ticket;
    }
    // update status
    public function updateStatus(Request $request) {
        $status = $this->ticketServices->updateStatus($request);
        return  $status;
    }
}
