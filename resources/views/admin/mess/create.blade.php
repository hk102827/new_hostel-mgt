@extends('layouts.admin')

@section('title', 'Add Mess Record')
@section('page-title', 'Create Mess Record')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Add New Mess Subscription</h2>

    <form action="{{ route('admin.mess.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Student -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
            <select name="student_id" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="">Select student</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>{{ $s->name }} (ID: {{ $s->id }})</option>
                @endforeach
            </select>
            @error('student_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Plan Type -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Mess Plan</label>
            <select name="plan_type" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="full_board" {{ old('plan_type')=='full_board' ? 'selected' : '' }}>Full board</option>
                <option value="breakfast_lunch" {{ old('plan_type')=='breakfast_lunch' ? 'selected' : '' }}>Breakfast + Lunch</option>
                <option value="lunch_dinner" {{ old('plan_type')=='lunch_dinner' ? 'selected' : '' }}>Lunch + Dinner</option>
                <option value="lunch_only" {{ old('plan_type')=='lunch_only' ? 'selected' : '' }}>Lunch only</option>
            </select>
            @error('plan_type')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Monthly Fee -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Monthly Fee</label>
            <input type="number" step="0.01" name="monthly_fee" value="{{ old('monthly_fee') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('monthly_fee')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Start Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('start_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- End Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">End Date (optional)</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('end_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="active" {{ old('status','active')=='active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ old('status')=='suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Dietary Restrictions -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Dietary Restrictions (optional)</label>
            <textarea name="dietary_restrictions" rows="3" class="px-3 py-2 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">{{ old('dietary_restrictions') }}</textarea>
            @error('dietary_restrictions')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.mess.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
        </div>
    </form>
</div>
@endsection