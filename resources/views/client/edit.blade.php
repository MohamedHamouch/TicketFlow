@extends('layouts.app')

@section('title', 'Edit Ticket')

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Ticket</h2>
            <p class="mt-1 text-sm text-gray-600">Update the details of your support ticket.</p>
          </div>

          <form action="{{ route('client.tickets.update', $ticket) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
              <input type="text" name="title" id="title"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                value="{{ old('title', $ticket->title) }}"
                required>
              @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Software Selection -->
            <div>
              <label for="software_id" class="block text-sm font-medium text-gray-700">Software</label>
              <select name="software_id" id="software_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                <option value="" disabled selected>Select Software</option>
                @foreach ($softwares as $sw)
                  <option value="{{ $sw->id }}" {{ old('software_id', $ticket->software_id) == $sw->id ? 'selected' : '' }}>
                    {{ $sw->name }}
                  </option>
                @endforeach
              </select>
              @error('software_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Description -->
            <div>
              <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
              <textarea name="description" id="description" rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                required>{{ old('description', $ticket->description) }}</textarea>
              @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Priority -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Priority</label>
              <div class="mt-2 space-x-4">
                <label class="inline-flex items-center">
                  <input type="radio" name="priority" value="High" class="form-radio text-red-600"
                    {{ old('priority', $ticket->priority) == 'High' ? 'checked' : '' }}>
                  <span class="ml-2 text-sm text-gray-700">High</span>
                </label>
                <label class="inline-flex items-center">
                  <input type="radio" name="priority" value="Medium" class="form-radio text-yellow-600"
                    {{ old('priority', $ticket->priority) == 'Medium' ? 'checked' : '' }}>
                  <span class="ml-2 text-sm text-gray-700">Medium</span>
                </label>
                <label class="inline-flex items-center">
                  <input type="radio" name="priority" value="Low" class="form-radio text-green-600"
                    {{ old('priority', $ticket->priority) == 'Low' ? 'checked' : '' }}>
                  <span class="ml-2 text-sm text-gray-700">Low</span>
                </label>
              </div>
              @error('priority')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Operating System -->
            <div>
              <label for="os" class="block text-sm font-medium text-gray-700">Operating System</label>
              <select name="os" id="os"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                required>
                <option value="">Select Operating System</option>
                <option value="Windows" {{ old('os', $ticket->os) == 'Windows' ? 'selected' : '' }}>Windows</option>
                <option value="macOS" {{ old('os', $ticket->os) == 'macOS' ? 'selected' : '' }}>macOS</option>
                <option value="Linux" {{ old('os', $ticket->os) == 'Linux' ? 'selected' : '' }}>Linux</option>
                <option value="Other" {{ old('os', $ticket->os) == 'Other' ? 'selected' : '' }}>Other</option>
              </select>
              @error('os')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
              <a href="{{ route('client.tickets.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
              </a>
              <button type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Ticket
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection