@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header with Create Button -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800">My Tickets</h2>
      <a href="{{ route('client.tickets.create') }}"
      class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
        clip-rule="evenodd" />
      </svg>
      Create New Ticket
      </a>
    </div>

    <!-- Tickets Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Open Tickets Column -->
      <div class="space-y-4">
      <h3 class="text-lg font-semibold text-gray-700 bg-gray-100 p-3 rounded-t-lg">Open</h3>
      @foreach ($tickets->where('status', 'Open') as $ticket)
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 
        @if ($ticket->priority === 'High') border-red-500
      @elseif($ticket->priority === 'Medium') border-yellow-500
    @else border-green-500 @endif">
        <div class="flex justify-between items-start">
        <h4 class="text-lg font-semibold text-gray-800">{{ $ticket->title }}</h4>
        <span class="px-2 py-1 text-sm rounded-full 
        @if ($ticket->priority === 'High') bg-red-100 text-red-800
      @elseif($ticket->priority === 'Medium') bg-yellow-100 text-yellow-800
    @else bg-green-100 text-green-800 @endif">
          {{ $ticket->priority }}
        </span>
        </div>
        <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($ticket->description, 100) }}</p>
        <div class="mt-4 space-y-2">
        <div class="flex items-center text-sm text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          OS: {{ $ticket->os }}
        </div>
        <div class="flex items-center text-sm text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Created: {{ $ticket->created_at->diffForHumans() }}
        </div>
        </div>
        <div class="mt-4 flex justify-end space-x-3">
        <a href="{{ route('client.tickets.edit', $ticket) }}"
          class="text-indigo-600 hover:text-indigo-800 inline-flex items-center">
          <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Edit
        </a>

        <form action="{{ route('client.tickets.destroy', $ticket) }}" method="POST" class="inline-block"
          onsubmit="return confirm('Are you sure you want to delete this ticket? This action cannot be undone.');">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-600 hover:text-red-800 inline-flex items-center">
          <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          Delete
          </button>
        </form>
        </div>
        </div>
    @endforeach
      </div>

      <!-- In Progress Tickets Column -->
      <div class="space-y-4">
      <h3 class="text-lg font-semibold text-gray-700 bg-gray-100 p-3 rounded-t-lg">In Progress</h3>
      @foreach ($tickets->where('status', 'In Progress') as $ticket)
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 
        @if ($ticket->priority === 'High') border-red-500
      @elseif($ticket->priority === 'Medium') border-yellow-500
    @else border-green-500 @endif">
        <!-- Same card content as above -->
        <div class="flex justify-between items-start">
        <h4 class="text-lg font-semibold text-gray-800">{{ $ticket->title }}</h4>
        <span class="px-2 py-1 text-sm rounded-full 
        @if ($ticket->priority === 'High') bg-red-100 text-red-800
      @elseif($ticket->priority === 'Medium') bg-yellow-100 text-yellow-800
    @else bg-green-100 text-green-800 @endif">
          {{ $ticket->priority }}
        </span>
        </div>
        <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($ticket->description, 100) }}</p>
        <div class="mt-4 space-y-2">
        <div class="flex items-center text-sm text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          OS: {{ $ticket->os }}
        </div>
        <div class="flex items-center text-sm text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Created: {{ $ticket->created_at->diffForHumans() }}
        </div>
        </div>
        <div class="mt-4 flex justify-end space-x-3">
        <a href="{{ route('client.tickets.edit', $ticket) }}"
          class="text-indigo-600 hover:text-indigo-800 inline-flex items-center">
          <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Edit
        </a>

        <form action="{{ route('client.tickets.destroy', $ticket) }}" method="POST" class="inline-block"
          onsubmit="return confirm('Are you sure you want to delete this ticket? This action cannot be undone.');">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-600 hover:text-red-800 inline-flex items-center">
          <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          Delete
          </button>
        </form>
        </div>
        </div>
    @endforeach
      </div>

      <!-- Closed Tickets Column -->
      <div class="space-y-4">
      <h3 class="text-lg font-semibold text-gray-700 bg-gray-100 p-3 rounded-t-lg">Closed</h3>
      @foreach ($tickets->where('status', 'Closed') as $ticket)
        <div class="bg-white rounded-lg shadow-md p-4 border-l-4 
        @if ($ticket->priority === 'High') border-red-500
      @elseif($ticket->priority === 'Medium') border-yellow-500
    @else border-green-500 @endif">
        <!-- Same card content as above -->
        <div class="flex justify-between items-start">
        <h4 class="text-lg font-semibold text-gray-800">{{ $ticket->title }}</h4>
        <span class="px-2 py-1 text-sm rounded-full 
        @if ($ticket->priority === 'High') bg-red-100 text-red-800
      @elseif($ticket->priority === 'Medium') bg-yellow-100 text-yellow-800
    @else bg-green-100 text-green-800 @endif">
          {{ $ticket->priority }}
        </span>
        </div>
        <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($ticket->description, 100) }}</p>
        <div class="mt-4 space-y-2">
        <div class="flex items-center text-sm text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          OS: {{ $ticket->os }}
        </div>
        <div class="flex items-center text-sm text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Created: {{ $ticket->created_at->diffForHumans() }}
        </div>
        </div>
        <div class="mt-4 flex justify-end space-x-3">
        <a href="{{ route('client.tickets.edit', $ticket) }}"
          class="text-indigo-600 hover:text-indigo-800 inline-flex items-center">
          <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Edit
        </a>

        <form action="{{ route('client.tickets.destroy', $ticket) }}" method="POST" class="inline-block"
          onsubmit="return confirm('Are you sure you want to delete this ticket? This action cannot be undone.');">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-600 hover:text-red-800 inline-flex items-center">
          <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          Delete
          </button>
        </form>
        </div>
        </div>
    @endforeach
      </div>
    </div>
    </div>
  </div>
@endsection