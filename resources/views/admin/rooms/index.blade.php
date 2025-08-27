
{{-- resources/views/admin/students/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Students')
@section('page-title', 'Hostel Students Management')

@section('content')
<div class="space-y-6">
    <span class="alert alert-success">{{ session('success') }}</span>
    <!-- Header with Add Button -->
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">All Rooms</h2>
        <a href="{{ route('admin.rooms.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Add New Room
        </a>
    </div>
    
    <!-- Students Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Room #</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Room Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Capacity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Occupied</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rent</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Facilities</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($rooms as $room)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $room->room_number }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $room->room_type }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $room->capacity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($room->occupied)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Yes
                            </span>
                        @else
                            <span class="text-gray-400">Not enrolled</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${{ number_format($room->rent, 2) }}
                    </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($room->status == 'available')
                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Available
                            </span>
                        @elseif($room->status == 'full')
                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                Occupied
                            </span>
                        @elseif($room->status == 'maintenance')
                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Maintenance
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                Unknown
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $room->facilities }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.rooms.edit', $room->id) }}" 
                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition">Edit</a>
                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this room?');">
                                Delete
                            </button>
                        </form>
                    
                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.students.show', $student) }}" 
                           class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                        <a href="{{ route('admin.students.edit', $student) }}" 
                           class="text-green-600 hover:text-green-900 mr-3">Edit</a>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
    </div>
    <div class="px-6 py-3 border-t">
        {{ $rooms->links() }}
    </div>
</div>
@endsection