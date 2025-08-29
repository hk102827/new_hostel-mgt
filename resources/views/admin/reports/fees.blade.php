{{-- resources/views/admin/reports/fees.blade.php --}}
@extends('layouts.admin')

@section('title', 'Fee Report')
@section('page-title', 'Fee Report')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded shadow">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="">All</option>
                    <option value="pending" {{ ($status ?? '')==='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ ($status ?? '')==='paid' ? 'selected' : '' }}>Paid</option>
                    <option value="overdue" {{ ($status ?? '')==='overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-700 mb-1">From (Due Date)</label>
                <input type="date" name="from" value="{{ $from }}" class="w-full border rounded px-3 py-2" />
            </div>
            <div>
                <label class="block text-sm text-gray-700 mb-1">To (Due Date)</label>
                <input type="date" name="to" value="{{ $to }}" class="w-full border rounded px-3 py-2" />
            </div>
            <div class="flex items-end">
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
            </div>
            <div class="flex items-end">
                <a href="{{ route('admin.reports.fees.download', request()->query()) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-center w-full">Download CSV</a>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="text-left p-2">ID</th>
                    <th class="text-left p-2">Student</th>
                    <th class="text-left p-2">Fee Type</th>
                    <th class="text-left p-2">Amount</th>
                    <th class="text-left p-2">Paid Amount</th>
                    <th class="text-left p-2">Balance</th>
                    <th class="text-left p-2">Status</th>
                    <th class="text-left p-2">Due Date</th>
                    <th class="text-left p-2">Paid Date</th>
                    <th class="text-left p-2">Payment Method</th>
                    <th class="text-left p-2">Receipt #</th>
                    <th class="text-left p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $f)
                <tr class="border-b">
                    <td class="p-2">{{ $f->id }}</td>
                    <td class="p-2">{{ optional($f->student)->name }}</td>
                     <td>
                    @if(!empty($f->fee_type))
                        {{ implode(', ', json_decode($f->fee_type, true)) }}
                    @else
                        -
                    @endif
                </td>
                    <td class="p-2">{{ $f->amount }}</td>
                    <td class="p-2">{{ $f->paid_amount }}</td>
                    <td class="p-2">{{ max(($f->amount ?? 0) - ($f->paid_amount ?? 0), 0) }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded text-white {{ $f->status === 'paid' ? 'bg-green-600' : ($f->status === 'overdue' ? 'bg-red-600' : 'bg-yellow-600') }}">
                            {{ ucfirst($f->status) }}
                        </span>
                    </td>
                    <td class="p-2">{{ $f->due_date ? \Carbon\Carbon::parse($f->due_date)->format('d-m-Y') : '' }}</td>
                    <td class="p-2">{{ $f->paid_date ? \Carbon\Carbon::parse($f->paid_date)->format('d-m-Y') : '' }}</td>
                    <td class="p-2">{{ $f->payment_method }}</td>
                    <td class="p-2">{{ $f->receipt_number }}</td>
                    <td class="p-2">
                        @if($f->student)
                            <a href="{{ route('admin.student.details', ['id' => $f->student->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700">
                                View Details
                            </a>
                        @else
                            <span class="text-gray-400 text-xs">N/A</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="p-4 text-center text-gray-500">No records found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $fees->links() }}
        </div>
    </div>
</div>
@endsection