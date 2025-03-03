@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 py-6">
    <div class="mb-6">
    <h1 class="text-2xl font-bold mb-4">My Assigned Tickets</h1>

    {{-- Priority Filters --}}
    <div class="flex gap-2 mb-6">
      <a href="{{ route('developer.tickets.index') }}"
      class="px-4 py-2 rounded-md {{ !request('priority') ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
      All Tickets
      </a>
      <a href="{{ route('developer.tickets.index', ['priority' => 'high']) }}"
      class="px-4 py-2 rounded-md {{ request('priority') === 'high' ? 'bg-red-600 text-white' : 'bg-gray-200' }}">
      High Priority
      </a>
      <a href="{{ route('developer.tickets.index', ['priority' => 'medium']) }}"
      class="px-4 py-2 rounded-md {{ request('priority') === 'medium' ? 'bg-yellow-600 text-white' : 'bg-gray-200' }}">
      Medium Priority
      </a>
      <a href="{{ route('developer.tickets.index', ['priority' => 'low']) }}"
      class="px-4 py-2 rounded-md {{ request('priority') === 'low' ? 'bg-green-600 text-white' : 'bg-gray-200' }}">
      Low Priority
      </a>
    </div>
    </div>

    {{-- Tickets List --}}
    <div class="grid gap-4">
    @forelse ($tickets as $ticket)
    <div class="border rounded-lg p-4 bg-white shadow">
      <div class="flex justify-between items-start mb-4">
      <div>
      <h3 class="text-lg font-semibold">{{ $ticket->title }}</h3>
      <p class="text-sm text-gray-600">Ticket #{{ $ticket->id }}</p>
      </div>
      <span class="px-3 py-1 rounded-full text-sm 
      @if($ticket->priority === 'high') bg-red-100 text-red-800
    @elseif($ticket->priority === 'medium') bg-yellow-100 text-yellow-800
      @else bg-green-100 text-green-800
  @endif">
      {{ ucfirst($ticket->priority) }}
      </span>
      </div>

      <div class="mb-4">
      <p class="text-gray-700">{{ $ticket->description }}</p>
      </div>

      <div class="flex justify-between items-center text-sm text-gray-600">
      <div>
      <span>Software: {{ $ticket->software->name }}</span>
      <span class="mx-2">|</span>
      <span>OS: {{ $ticket->os }}</span>
      </div>

      @if($ticket->status === 'In Progress')
      <form action="{{ route('developer.tickets.close', $ticket) }}" method="POST" class="inline">
      @csrf
      @method('PATCH')
      <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600"
      onclick="return confirm('Are you sure you want to close this ticket?')">
      Mark as Closed
      </button>
      </form>
    @else
      <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full">Closed</span>
    @endif
      </div>
    </div>
  @empty
  <div class="text-center py-8 text-gray-600">
    <p>No tickets found.</p>
  </div>
@endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
    {{ $tickets->links() }}
    </div>
  </div>
@endsection