<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Assignment;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['user', 'software', 'currentDeveloper'])
            ->latest()
            ->get();

        $developers = User::where('role', 'developer')->get();

        return view('admin.index', compact('tickets', 'developers'));
    }

    public function assignDeveloper(Request $request, Ticket $ticket)
    {
        $request->validate([
            'developer_id' => 'required|exists:users,id'
        ]);

        Assignment::create([
            'ticket_id' => $ticket->id,
            'developer_id' => $request->developer_id,
            'admin_id' => auth()->id()
        ]);

        $ticket->update(['status' => 'In Progress']);

        return back()->with('success', 'Ticket successfully assigned to developer.');
    }
}
