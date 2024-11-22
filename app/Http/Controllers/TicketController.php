<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Services\TicketServices;

class TicketController extends Controller
{
    protected TicketServices $ticketServices;

    public function __construct(
        TicketServices $ticketServices
    )
    {
        $this->ticketServices = $ticketServices;
    }
    //list ticket
    public function getTicket() {
        $dataList  = $this->ticketServices->getTicket();
        return response()->json($dataList);
       
    }
    // create ticket
    public function createTicket(Request $request) {
        $this->ticketServices->createTicket($request);
    }
}
