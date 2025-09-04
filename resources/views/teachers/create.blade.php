@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Add Teacher</h2>

    <form method="POST" action="{{ route('admin.teachers.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border rounded p-2" required>
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full border rounded p-2">
            @error('phone')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium">CNIC</label>
            <input type="text" name="cnic" value="{{ old('cnic') }}" class="mt-1 block w-full border rounded p-2">
            @error('cnic')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex gap-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('admin.teachers.index') }}" class="px-4 py-2 rounded border">Cancel</a>
        </div>
    </form>
</div>
@endsection