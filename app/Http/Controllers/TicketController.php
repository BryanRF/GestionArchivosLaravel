<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show($id) {
        // Obtén el ticket por su ID y luego muestra la vista correspondiente
        $ticket = Ticket::with(['category','ticketDetails','incident.item','incident.employee'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }
}
