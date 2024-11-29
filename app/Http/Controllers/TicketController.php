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
}
