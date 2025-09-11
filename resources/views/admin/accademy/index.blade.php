@extends('layouts.admin')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Japanese Academy Students</h1>

        {{-- Filters --}}
        <div class="mb-4 flex space-x-4 justify-between items-center">
            <form method="GET" action="" class="flex space-x-2">
                <select name="type" class="border p-2 rounded">
                    <option value="">All Types</option>
                    <option value="online" {{ request('type') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="physical" {{ request('type') == 'physical' ? 'selected' : '' }}>Physical</option>
                </select>

                <select name="hostel" class="border p-2 rounded">
                    <option value="">All Hostel Status</option>
                    <option value="1" {{ request('hostel') == '1' ? 'selected' : '' }}>In Hostel</option>
                    <option value="0" {{ request('hostel') == '0' ? 'selected' : '' }}>Not in Hostel</option>
                </select>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
            </form>
             
                <a href="{{ route('admin.academy.create') }}" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Add New Student
                </a>


        </div>
    

        {{-- Students Table --}}
        <table class="min-w-full bg-white border rounded shadow">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Father Name</th>
                    <th class="px-6 py-3 text-left">Type</th>
                    <th class="px-6 py-3 text-left">Hostel</th>
                    <th class="px-6 py-3 text-left">Phone</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $student->name }}</td>
                        <td class="px-6 py-4">{{ $student->father_name }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded text-white 
                        {{ $student->type == 'online' ? 'bg-blue-500' : 'bg-green-500' }}">
                                {{ ucfirst($student->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if ($student->is_in_hostel)
                                <span class="bg-purple-500 text-white px-2 py-1 rounded">Yes</span>
                            @else
                                <span class="bg-gray-400 text-white px-2 py-1 rounded">No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $student->phone }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('admin.academy.show', $student->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded">View</a>
                   
                            <a href="{{ route('admin.academy.edit', $student->id) }}" 
                            class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.academy.destroy', $student->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                   

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No students found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


@endsection
