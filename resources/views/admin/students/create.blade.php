{{-- resources/views/admin/students/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Add Student')
@section('page-title', 'Add New Student')

@section('content')
<div class="max-w-3xl mx-auto">
    
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form method="POST" action="{{ route('admin.students.store') }}">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name *</label>
                    <input type="text" name="father_name" value="{{ old('father_name') }}" 
                           class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CNIC *</label>
                    <input type="text" name="cnic" value="{{ old('cnic') }}" placeholder="12345-6789012-3"
                           class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" 
                           class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                    <textarea name="address" rows="3" 
                              class="px-3 py-2 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">{{ old('address') }}</textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact *</label>
                    <input type="text" name="emergency_contact" value="{{ old('emergency_contact') }}" 
                           class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Admission Date *</label>
                    <input type="date" name="admission_date" value="{{ old('admission_date') }}" 
                           class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Assign Room</label>
                    <select name="room_id" 
                            class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                        <option value="">Select Room (Optional)</option>
                        @foreach($available_rooms as $room)
                            <option value="{{ $room->id }}">
                                {{ $room->room_number }} ({{ $room->capacity - $room->occupied }} spaces available)
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.students.index') }}" 
                   class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 transition">
                    Add Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
