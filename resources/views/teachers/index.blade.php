@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Teachers</h2>
        <a href="{{ route('admin.teachers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Add Teacher</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CNIC</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($teachers as $t)
                    <tr>
                        <td class="px-6 py-4">{{ $t->name }}</td>
                        <td class="px-6 py-4">{{ $t->phone }}</td>
                        <td class="px-6 py-4">{{ $t->cnic }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.teachers.edit', $t->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.teachers.destroy', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this teacher?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="px-6 py-4" colspan="4">No teachers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $teachers->links() }}</div>
</div>
@endsection