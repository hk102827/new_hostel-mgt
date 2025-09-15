@extends('layouts.admin')

@section('title', 'Fee Management')
@section('page-title', 'Fee Management')

@section('content')
<div class="container mx-auto">

    {{-- Filters --}}
    <div class="mb-6 bg-white p-4 rounded-lg shadow">
        <form method="GET" action="{{ route('admin.fees.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
            
            <!-- Fee Type Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fee Type</label>
                <select name="fee_type" class="w-full border border-gray-300 p-2 rounded-md text-sm">
                    <option value="">All Fee Types</option>
                    <option value="monthly_fee" {{ request('fee_type')=='monthly_fee' ? 'selected' : '' }}>Monthly Fee</option>
                    <option value="admission_fee" {{ request('fee_type')=='admission_fee' ? 'selected' : '' }}>Admission Fee</option>
                    <option value="registration_fee" {{ request('fee_type')=='registration_fee' ? 'selected' : '' }}>Registration Fee</option>
                    <option value="hostel_fee" {{ request('fee_type')=='hostel_fee' ? 'selected' : '' }}>Hostel Fee</option>
                    <option value="previous_month_fee" {{ request('fee_type')=='previous_month_fee' ? 'selected' : '' }}>Previous Month Fee</option>
                    <option value="other_fee" {{ request('fee_type')=='other_fee' ? 'selected' : '' }}>Other Fee</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-300 p-2 rounded-md text-sm">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status')=='paid' ? 'selected' : '' }}>Paid</option>
                    <option value="partial" {{ request('status')=='partial' ? 'selected' : '' }}>Partial</option>
                </select>
            </div>

            <!-- Student Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
                <select name="student_id" class="w-full border border-gray-300 p-2 rounded-md text-sm">
                    <option value="">All Students</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ request('student_id')==$student->id ? 'selected' : '' }}>
                            {{ $student->name }} ({{ $student->id }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fees Month Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Month</label>
                <select name="fees_month" class="w-full border border-gray-300 p-2 rounded-md text-sm">
                    <option value="">All Months</option>
                    @foreach($feesMonths as $month)
                        <option value="{{ $month }}" {{ request('fees_month')==$month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date From -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="w-full border border-gray-300 p-2 rounded-md text-sm">
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">
                    Filter
                </button>
                <a href="{{ route('admin.fees.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-sm">
                    Clear
                </a>
            </div>
        </form>
    </div>

    {{-- Header with Add Button --}}
    <div class="mb-4 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">
            Fee Records 
            <span class="text-sm text-gray-500">({{ $fees->total() }} total)</span>
        </h3>
        <a href="{{ route('admin.fees.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Fee
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Month</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Breakdown</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deposit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($fees as $fee)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ optional($fee->student)->name ?? 'N/A' }}
                            </div>
                            <div class="text-sm text-gray-500">ID: {{ $fee->student_id }}</div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ \Carbon\Carbon::createFromFormat('Y-m', $fee->fees_month)->format('M Y') }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($fee->date)->format('d-m-Y') }}
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-xs text-gray-600 space-y-1">
                                @if($fee->monthly_fee > 0)
                                    <div>Monthly: <span class="font-medium">{{ number_format($fee->monthly_fee) }}</span></div>
                                @endif
                                @if($fee->admission_fee > 0)
                                    <div>Admission: <span class="font-medium">{{ number_format($fee->admission_fee) }}</span></div>
                                @endif
                                @if($fee->registration_fee > 0)
                                    <div>Registration: <span class="font-medium">{{ number_format($fee->registration_fee) }}</span></div>
                                @endif
                                @if($fee->hostel_fee > 0)
                                    <div>Hostel: <span class="font-medium">{{ number_format($fee->hostel_fee) }}</span></div>
                                @endif
                                @if($fee->previous_month_fee > 0)
                                    <div>Previous: <span class="font-medium">{{ number_format($fee->previous_month_fee) }}</span></div>
                                @endif
                                @if($fee->discount > 0)
                                    <div class="text-green-600">Discount: <span class="font-medium">-{{ number_format($fee->discount) }}</span></div>
                                @endif
                                @if($fee->other_fee > 0)
                                    <div>Other: <span class="font-medium">{{ number_format($fee->other_fee) }}</span></div>
                                @endif
                                @if($fee->monthly_fee == 0 && $fee->admission_fee == 0 && $fee->registration_fee == 0 && $fee->hostel_fee == 0 && $fee->previous_month_fee == 0 && $fee->other_fee == 0)
                                    <div class="text-gray-400">No fees</div>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">
                                {{ number_format($fee->total_amount) }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ number_format($fee->deposit) }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium {{ $fee->due_balance > 0 ? 'text-red-600' : 'text-green-600' }}">
                                {{ number_format($fee->due_balance) }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $fee->status == 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $fee->status == 'partial' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $fee->status == 'pending' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst($fee->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.fees.show', $fee->id) }}" 
                                   class="text-blue-600 hover:text-blue-900" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.fees.edit', $fee->id) }}" 
                                   class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.fees.destroy', $fee->id) }}" method="POST" 
                                      class="inline" onsubmit="return confirm('Are you sure you want to delete this fee record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No fee records found</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new fee record.</p>
                                <div class="mt-6">
                                    <a href="{{ route('admin.fees.create') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        Add Fee
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($fees->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $fees->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    {{-- Summary Cards --}}
    <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-600">Total Records</div>
            <div class="text-2xl font-bold text-gray-900">{{ $fees->total() }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-600">Total Amount</div>
            <div class="text-2xl font-bold text-blue-600">{{ number_format($fees->sum('total_amount')) }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-600">Total Collected</div>
            <div class="text-2xl font-bold text-green-600">{{ number_format($fees->sum('deposit')) }}</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-sm text-gray-600">Total Pending</div>
            <div class="text-2xl font-bold text-red-600">{{ number_format($fees->sum('due_balance')) }}</div>
        </div>
    </div>
</div>
@endsection