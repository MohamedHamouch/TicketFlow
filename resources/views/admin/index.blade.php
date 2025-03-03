@extends('layouts.app')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
  @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
      <h2 class="text-2xl font-bold mb-4">Manage Tickets</h2>

      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Status</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Priority</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Title</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Client</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Software</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            OS</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Developer</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($tickets as $ticket)
        <tr>
        <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
        {{ $ticket->status === 'Open' ? 'bg-yellow-100 text-yellow-800' : '' }}
        {{ $ticket->status === 'In Progress' ? 'bg-blue-100 text-blue-800' : '' }}
        {{ $ticket->status === 'Closed' ? 'bg-green-100 text-green-800' : '' }}">
        {{ $ticket->status }}
        </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
        {{ $ticket->priority === 'High' ? 'bg-red-100 text-red-800' : '' }}
        {{ $ticket->priority === 'Medium' ? 'bg-yellow-100 text-yellow-800' : '' }}
        {{ $ticket->priority === 'Low' ? 'bg-green-100 text-green-800' : '' }}">
        {{ $ticket->priority }}
        </span>
        </td>
        <td class="px-6 py-4">{{ $ticket->title }}</td>
        <td class="px-6 py-4">{{ $ticket->user->name }}</td>
        <td class="px-6 py-4">{{ $ticket->software->name }}</td>
        <td class="px-6 py-4">{{ $ticket->os }}</td>
        <td class="px-6 py-4">
        {{ $ticket->currentDeveloper?->name ?? 'Unassigned' }}
        </td>
        <td class="px-6 py-4">
        @if($ticket->status !== 'Closed')
      <button onclick="openAssignModal({{ $ticket->id }})" class="text-indigo-600 hover:text-indigo-900">
      {{ $ticket->currentDeveloper ? 'Reassign' : 'Assign' }}
      </button>
    @endif
        </td>
        </tr>
      @empty
      <tr>
      <td colspan="8" class="px-6 py-4 text-center text-gray-500">
      No tickets found
      </td>
      </tr>
    @endforelse
        </tbody>
        </table>
      </div>
      </div>
    </div>
    </div>
  </div>

  <!-- Assignment Modal -->
  <div id="assignModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="mt-3">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Assign Ticket</h3>
      <form id="assignForm" method="POST" class="mt-4">
      @csrf
      <div class="mb-4">
        <label for="developer_id" class="block text-sm font-medium text-gray-700">Select Developer</label>
        <select name="developer_id" id="developer_id" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Choose a developer</option>
        @foreach($developers as $developer)
      <option value="{{ $developer->id }}">{{ $developer->name }}</option>
    @endforeach
        </select>
      </div>

      <div class="flex justify-end gap-4">
        <button type="button" onclick="closeAssignModal()"
        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">
        Cancel
        </button>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
        Assign
        </button>
      </div>
      </form>
    </div>
    </div>
  </div>

  @push('scripts')
    <script>
    function openAssignModal(ticketId) {
    const modal = document.getElementById('assignModal');
    const form = document.getElementById('assignForm');
    form.action = `/admin/tickets/${ticketId}/assign`;
    modal.classList.remove('hidden');
    }

    function closeAssignModal() {
    const modal = document.getElementById('assignModal');
    modal.classList.add('hidden');
    }
    </script>
  @endpush
@endsection