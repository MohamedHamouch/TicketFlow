<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class DeveloperTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::whereHas('assignments', function ($query) {
            $query->where('developer_id', auth()->id());
        });


        if ($request->has('priority')) {
            $query->where('priority', ucfirst($request->priority));
        }
        $tickets = $query->latest()->paginate(10);

        return view('developer.index', compact('tickets'));
    }
}
