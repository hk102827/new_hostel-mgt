@extends('layouts.admin')

@section('title', 'Edit Academy Student')
@section('page-title', 'Edit Academy Student')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Edit Japanese Academy Student</h2>

    <form action="{{ route('admin.academy.update', $student->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Student (existing hostel student reference) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Select Linked Hostel Student (optional)</label>
            <select name="student_id" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="">-- None --</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" {{ old('student_id', $student->student_id) == $s->id ? 'selected' : '' }}>
                        {{ $s->name }} (ID: {{ $s->id }})
                    </option>
                @endforeach
            </select>
            @error('student_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Father Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Father Name</label>
            <input type="text" name="father_name" value="{{ old('father_name', $student->father_name) }}"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('father_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- CNIC -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">CNIC</label>
            <input type="text" name="cnic" value="{{ old('cnic', $student->cnic) }}"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('cnic')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Student Type -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Student Type</label>
            <select name="student_type" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="online" {{ old('student_type', $student->student_type) == 'online' ? 'selected' : '' }}>Online</option>
                <option value="physical" {{ old('student_type', $student->student_type) == 'physical' ? 'selected' : '' }}>Physical</option>
            </select>
            @error('student_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Hostel -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Hostel</label>
            <select name="hostel" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="0" {{ old('hostel', (int)$student->hostel) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('hostel', (int)$student->hostel) == 1 ? 'selected' : '' }}>Yes</option>
            </select>
            @error('hostel')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Admission Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Admission Date</label>
            <input type="date" name="admission_date" value="{{ old('admission_date', optional($student->admission_date)->format('Y-m-d')) }}"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('admission_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Course -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
            <input type="text" name="course" value="{{ old('course', $student->course) }}"
                   class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('course')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="completed" {{ old('status', $student->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.academy.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection