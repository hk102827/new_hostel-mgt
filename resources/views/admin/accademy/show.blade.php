@extends('layouts.admin')

@section('title', 'Academy Student Details')
@section('page-title', 'Academy Student Details')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">{{ $student->name }}</h2>
        <div class="space-x-2">
            <a href="{{ route('admin.academy.edit', $student->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
            <a href="{{ route('admin.academy.index') }}" class="px-3 py-1 border rounded">Back</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm text-gray-600">Father Name</p>
            <p class="font-medium">{{ $student->father_name ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">CNIC</p>
            <p class="font-medium">{{ $student->cnic }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Phone</p>
            <p class="font-medium">{{ $student->phone ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Student Type</p>
            <p class="font-medium">{{ ucfirst($student->student_type) }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Hostel</p>
            <p class="font-medium">{{ $student->hostel ? 'Yes' : 'No' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Admission Date</p>
            <p class="font-medium">{{ $student->admission_date ? \Carbon\Carbon::parse($student->admission_date)->format('Y-m-d') : '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Course</p>
            <p class="font-medium">{{ $student->course ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Status</p>
            <p class="font-medium">{{ ucfirst($student->status) }}</p>
        </div>
    </div>
</div>
@endsection