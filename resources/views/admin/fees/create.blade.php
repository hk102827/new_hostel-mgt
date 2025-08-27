@extends('layouts.admin')

@section('title', 'Add Fee')
@section('page-title', 'Create Fee')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Create Fee</h2>

    <form action="{{ route('admin.fees.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Student -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
            <select name="student_id" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="">Select student</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" {{ old('student_id')==$s->id ? 'selected' : '' }}>{{ $s->name }} (ID: {{ $s->id }})</option>
                @endforeach
            </select>
            @error('student_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Fee Type -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fee Type</label>
            <select name="fee_type" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="hostel_rent" {{ old('fee_type')=='hostel_rent' ? 'selected' : '' }}>Hostel Rent</option>
                <option value="mess_fee" {{ old('fee_type')=='mess_fee' ? 'selected' : '' }}>Mess Fee</option>
                <option value="japanese_course" {{ old('fee_type')=='japanese_course' ? 'selected' : '' }}>Japanese Course</option>
                <option value="security_deposit" {{ old('fee_type')=='security_deposit' ? 'selected' : '' }}>Security Deposit</option>
                <option value="other" {{ old('fee_type')=='other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('fee_type')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Amount -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('amount')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Due Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('due_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Paid Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Paid Date (optional)</label>
            <input type="date" name="paid_date" value="{{ old('paid_date') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('paid_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="pending" {{ old('status','pending')=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ old('status')=='paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ old('status')=='overdue' ? 'selected' : '' }}>Overdue</option>
                <option value="partial" {{ old('status')=='partial' ? 'selected' : '' }}>Partial</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Paid Amount -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Paid Amount (optional)</label>
            <input type="number" step="0.01" name="paid_amount" value="{{ old('paid_amount') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('paid_amount')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Payment Method and Receipt -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method (optional)</label>
                <input type="text" name="payment_method" value="{{ old('payment_method') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                @error('payment_method')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Receipt Number (optional)</label>
                <input type="text" name="receipt_number" value="{{ old('receipt_number') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                @error('receipt_number')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Notes -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
            <textarea name="notes" rows="3" class="px-3 py-2 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">{{ old('notes') }}</textarea>
            @error('notes')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.fees.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
        </div>
    </form>
</div>
@endsection