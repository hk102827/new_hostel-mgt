@extends('layouts.admin')

@section('title', 'Edit Room')
@section('page-title', 'Edit Room')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Edit Room</h2>

    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Room Number -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Room Number</label>
            <input type="text" name="room_number" value="{{ old('room_number', $room->room_number) }}" 
                   placeholder="Enter room number"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md 
                          focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('room_number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Room Type -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Room Type</label>
        <select name="room_type" 
                class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md 
                    focus:border-indigo-500 focus:ring-indigo-500 text-base">
            <option value="">Select Room Type</option>
            <option value="Single" {{ strtolower(old('room_type', $room->room_type)) == 'single' ? 'selected' : '' }}>Single</option>
            <option value="Double" {{ strtolower(old('room_type', $room->room_type)) == 'double' ? 'selected' : '' }}>Double</option>
            <option value="Triple" {{ strtolower(old('room_type', $room->room_type)) == 'triple' ? 'selected' : '' }}>Triple</option>
            <option value="Quad" {{ strtolower(old('room_type', $room->room_type)) == 'quad' ? 'selected' : '' }}>Quad</option>
            <option value="Quint" {{ strtolower(old('room_type', $room->room_type)) == 'quint' ? 'selected' : '' }}>Quint</option>

        </select>
        @error('room_type')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

        <!-- Capacity Dropdown -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
            <select name="capacity" 
                    class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md 
                           focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="">Select capacity</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('capacity', $room->capacity) == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            @error('capacity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Occupied --}}
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Occupied</label>
            <input type="number" name="occupied" value="{{ old('occupied', $room->occupied) }}"
                   placeholder="Currently occupied (e.g. 0)"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md 
                          focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('occupied') 
            <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Rent -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Rent ($)</label>
            <input type="number" step="0.01" name="rent" value="{{ old('rent', $room->rent) }}" 
                   placeholder="Enter rent amount"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md 
                          focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('rent')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" 
                    class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md 
                           focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="full" {{ old('status', $room->status) == 'full' ? 'selected' : '' }}>Occupied</option>
                <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Facilities -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Facilities</label>
            <textarea name="facilities" rows="3" placeholder="Enter facilities (comma separated)" 
                      class="px-3 py-2 block w-full rounded-lg border-gray-300 shadow-md 
                             focus:border-indigo-500 focus:ring-indigo-500 text-base">{{ old('facilities', $room->facilities) }}</textarea>
            @error('facilities')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.rooms.index') }}" 
               class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Update Room
            </button>
        </div>
    </form>
</div>
@endsection
