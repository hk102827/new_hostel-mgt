
{{-- resources/views/admin/students/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Students')
@section('page-title', 'Hostel Students Management')

@section('content')
<div class="space-y-6">
    <span class="alert alert-success">{{ session('success') }}</span>
    <!-- Header with Add Button -->
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">All Students</h2>
        <a href="{{ route('admin.students.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Add New Student
        </a>
    </div>
    
    <!-- Students Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Room</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Japanese Course</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mess Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($students as $student)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                            <div class="text-sm text-gray-500">{{ $student->phone }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $student->roomAssignment ? $student->roomAssignment->room->room_number : 'Not assigned' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($student->japaneseAcademy)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $student->japaneseAcademy->level }}
                            </span>
                        @else
                            <span class="text-gray-400">Not enrolled</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($student->messManagement)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst(str_replace('_', ' ', $student->messManagement->plan_type)) }}
                            </span>
                        @else
                            <span class="text-gray-400">Not subscribed</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $student->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <a href="{{ route('admin.students.edit', $student->id) }}" 
                        class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition">
                            Edit
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                       <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                    </td>

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
        {{ $students->links() }}
    </div>
</div>
@endsection