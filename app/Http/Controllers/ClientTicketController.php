<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Software;

class ClientTicketController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $tickets = Ticket::where('user_id', auth()->id())->get();
    return view('client.index', compact('tickets'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $software = Software::all();
    // dd([
    //     'software_collection' => $software->toArray(),
    //     'first_item' => $software->first(),
    //     'count' => $software->count()
    // ]);
    return view('client.create', compact('software'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'priority' => 'required|in:High,Medium,Low',
      'os' => 'required|string',
      'software_id' => 'required|exists:software,id',
    ]);

    Ticket::create([
      'title' => $validated['title'],
      'description' => $validated['description'],
      'priority' => $validated['priority'],
      'os' => $validated['os'],
      'software_id' => $validated['software_id'],
      'status' => 'Open',
      'user_id' => auth()->id(),
    ]);

    return redirect()->route('client.tickets.index')->with('success', 'Ticket created successfully.');
  }
  /**
   * Display the specified resource.
   */
  // public function show(string $id)
  // {
  //     //
  // }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(ticket $ticket)
  {
    $softwares = Software::all();
    return view('client.edit', compact('ticket', 'softwares'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Ticket $ticket)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'priority' => 'required|in:High,Medium,Low',
      'os' => 'required|string',
      'software_id' => 'required|integer|exists:software,id',
    ]);

    $ticket->update([
      'title' => $validated['title'],
      'description' => $validated['description'],
      'priority' => $validated['priority'],
      'os' => $validated['os'],
      'software_id' => (int) $validated['software_id'],
    ]);

    return redirect()->route('client.tickets.index')->with('success', 'Ticket updated successfully.');

  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Ticket $ticket)
  {
    try {
      // Optional: Add authorization check
      if ($ticket->user_id !== auth()->id()) {
        return redirect()->route('client.tickets.index')->with('error', 'You are not authorized to delete this ticket.');
      }

      $ticket->delete();

      return redirect()->route('client.tickets.index')->with('success', 'Ticket deleted successfully.');
    } catch (\Exception $e) {
      return redirect()->route('client.tickets.index')->with('error', 'Failed to delete ticket. Please try again.');
    }
  }
}
