@extends('layouts.admin')
@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4">Student Details</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Phone:</strong> {{ $student->phone }}</p>
                <p><strong>Address:</strong> {{ $student->address }}</p>
                <p><strong> Enrollment Date:</strong> {{ $student->enrollment_date }}</p>
                <p><strong> Status:</strong> {{ $student->status }}</p> 
            </div>
         
        </div>
        <div class="mt-6">
            <h3 class="text-xl font-semibold mb-2">Room Assignment</h3>
            @if($student->roomAssignment)
                <p><strong>Room Number:</strong> {{ $student->roomAssignment->room->room_number }}</p>
                <p><strong>Assigned Date:</strong> {{ $student->roomAssignment->assigned_date }}</p>
                <p><strong>Status:</strong> {{ $student->roomAssignment->status }}</p>
            @else
                <p>No room assigned.</p>
            @endif
        </div>
    </div>  
    <div class="bg-white p-6 rounded-lg shadow mt-6">
        <h3 class="text-xl font-semibold mb-2">Japanese Academy Details</h3>
        @if($student->japaneseAcademy)
            <p><strong>Course Name:</strong> {{ $student->japaneseAcademy->course_name }}</p>
            <p><strong>Start Date:</strong> {{ $student->japaneseAcademy->start_date }}</p>
            <p><strong>End Date:</strong> {{ $student->japaneseAcademy->end_date }}</p>
            <p><strong>Status:</strong> {{ $student->japaneseAcademy->status }}</p>
        @else
            <p>No Japanese Academy details available.</p>
        @endif
    </div>
    <div class="bg-white p-6 rounded-lg shadow mt-6">
        <h3 class="text-xl font-semibold mb-2">Mess Management Details</h3>
        @if($student->messManagement)
            <p><strong>Meal Plan:</strong> {{ $student->messManagement->meal_plan }}</p>
            <p><strong>Start Date:</strong> {{ $student->messManagement->start_date }}</p>
            <p><strong>End Date:</strong> {{ $student->messManagement->end_date }}</p>
            <p><strong>Status:</strong> {{ $student->messManagement->status }}</p>
        @else
            <p>No Mess Management details available.</p>
        @endif
    </div>
</div>
@endsection