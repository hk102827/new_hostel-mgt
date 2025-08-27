@extends('layouts.admin')

@section('title', 'Fee Management')
@section('page-title', 'Fee Management')

@section('content')
<div class="container mx-auto">

    {{-- Filters --}}
   <div class="mb-4 flex space-x-4 justify-between items-center">
    <form method="GET" action="" class="flex flex-wrap gap-3 mb-4 items-center">
        <select name="fee_type" class="border p-2 rounded">
            <option value="">All Fee Types</option>
            <option value="hostel_rent" {{ request('fee_type')=='hostel_rent' ? 'selected' : '' }}>Hostel Rent</option>
            <option value="mess_fee" {{ request('fee_type')=='mess_fee' ? 'selected' : '' }}>Mess Fee</option>
            <option value="japanese_course" {{ request('fee_type')=='japanese_course' ? 'selected' : '' }}>Japanese Course</option>
            <option value="security_deposit" {{ request('fee_type')=='security_deposit' ? 'selected' : '' }}>Security Deposit</option>
            <option value="other" {{ request('fee_type')=='other' ? 'selected' : '' }}>Other</option>
        </select>
        <select name="status" class="border p-2 rounded">
            <option value="">All Status</option>
            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
            <option value="paid" {{ request('status')=='paid' ? 'selected' : '' }}>Paid</option>
            <option value="overdue" {{ request('status')=='overdue' ? 'selected' : '' }}>Overdue</option>
            <option value="partial" {{ request('status')=='partial' ? 'selected' : '' }}>Partial</option>
        </select>
        <select name="student_id" class="border p-2 rounded">
            <option value="">All Students</option>
            @foreach($students as $s)
                <option value="{{ $s->id }}" {{ request('student_id')==$s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->id }})</option>
            @endforeach
        </select>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>
        <a href="{{ route('admin.fees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Add Fee</a>
    </div>

    <table class="min-w-full bg-white border rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-3 text-left">Student</th>
                <th class="px-6 py-3 text-left">Type</th>
                <th class="px-6 py-3 text-left">Amount</th>
                <th class="px-6 py-3 text-left">Due</th>
                <th class="px-6 py-3 text-left">Paid</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fees as $fee)
            <tr class="border-t">
                <td class="px-6 py-3">{{ optional($fee->student)->name }} (ID: {{ $fee->student_id }})</td>
                <td class="px-6 py-3">{{ str_replace('_',' ', ucfirst($fee->fee_type)) }}</td>
                <td class="px-6 py-3">{{ number_format($fee->amount, 2) }}</td>
                <td class="px-6 py-3">{{ \Carbon\Carbon::parse($fee->due_date)->format('Y-m-d') }}</td>
                <td class="px-6 py-3">{{ $fee->paid_date ? \Carbon\Carbon::parse($fee->paid_date)->format('Y-m-d') : '-' }}</td>
                <td class="px-6 py-3">
                    <span class="px-2 py-1 rounded text-white {{ $fee->status=='paid' ? 'bg-green-600' : ($fee->status=='overdue' ? 'bg-red-600' : ($fee->status=='partial' ? 'bg-yellow-600' : 'bg-gray-600')) }}">
                        {{ ucfirst($fee->status) }}
                    </span>
                </td>
                <td class="px-6 py-3">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.fees.edit', $fee->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('admin.fees.destroy', $fee->id) }}" method="POST" onsubmit="return confirm('Delete this fee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4">No fees found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection