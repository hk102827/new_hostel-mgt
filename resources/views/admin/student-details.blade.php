{{-- resources/views/admin/student-details.blade.php --}}
@extends('layouts.admin')

@section('title', 'Student Details')
@section('page-title', 'Student Details')

@section('content')
<style>
@media print {
    .no-print { display: none !important; }
}
</style>
<div class="space-y-6">
    
    <!-- Top actions -->
    <div class="flex items-center justify-between no-print">
        <div>
            <button onclick="history.back()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                ← Go back
            </button>
        </div>
        <div>
            <button onclick="window.print()" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
                <i class="fas fa-print mr-2"></i> Print
            </button>
        </div>
    </div>

    <!-- Basic Info -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div><span class="text-gray-500">Name:</span> <span class="font-medium">{{ $student->name }}</span></div>
            <div><span class="text-gray-500">Father Name:</span> <span class="font-medium">{{ $student->father_name }}</span></div>
            <div><span class="text-gray-500">CNIC:</span> <span class="font-medium">{{ $student->cnic }}</span></div>
            <div><span class="text-gray-500">Phone:</span> <span class="font-medium">{{ $student->phone }}</span></div>
            <div><span class="text-gray-500">Email:</span> <span class="font-medium">{{ $student->email }}</span></div>
            <div><span class="text-gray-500">Emergency Contact:</span> <span class="font-medium">{{ $student->emergency_contact }}</span></div>
            <div><span class="text-gray-500">Admission Date:</span> <span class="font-medium">{{ optional($student->admission_date)->format('Y-m-d') }}</span></div>
            <div><span class="text-gray-500">Status:</span> <span class="font-medium">{{ ucfirst($student->status) }}</span></div>
            <div class="sm:col-span-2"><span class="text-gray-500">Address:</span> <span class="font-medium">{{ $student->address }}</span></div>
        </div>
    </div>

    <!-- Room Assignment -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Room Assignment</h2>
        @if($student->roomAssignment && $student->roomAssignment->room)
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div><span class="text-gray-500">Room Number:</span> <span class="font-medium">{{ $student->roomAssignment->room->room_number }}</span></div>
                <div><span class="text-gray-500">Type:</span> <span class="font-medium">{{ ucfirst($student->roomAssignment->room->room_type) }}</span></div>
                <div><span class="text-gray-500">Status:</span> <span class="font-medium">{{ ucfirst($student->roomAssignment->room->status) }}</span></div>
            </div>
        @else
            <p class="text-gray-500">No active room assignment.</p>
        @endif
    </div>

    <!-- Japanese Academy -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Japanese Academy</h2>
        @if($student->japaneseAcademy)
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div><span class="text-gray-500">Status:</span> <span class="font-medium">{{ ucfirst($student->japaneseAcademy->status ?? 'N/A') }}</span></div>
                <div><span class="text-gray-500">Course:</span> <span class="font-medium">{{ $student->japaneseAcademy->course ?? 'N/A' }}</span></div>
                <div><span class="text-gray-500">Batch:</span> <span class="font-medium">{{ $student->japaneseAcademy->batch ?? 'N/A' }}</span></div>
            </div>
        @else
            <p class="text-gray-500">Not enrolled in Japanese Academy.</p>
        @endif
    </div>

    <!-- Mess Management -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Mess Management</h2>
        @if($student->messManagement)
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div><span class="text-gray-500">Status:</span> <span class="font-medium">{{ ucfirst($student->messManagement->status ?? 'N/A') }}</span></div>
                <div><span class="text-gray-500">Plan:</span> <span class="font-medium">{{ $student->messManagement->plan ?? 'N/A' }}</span></div>
                <div><span class="text-gray-500">Started:</span> <span class="font-medium">{{ optional($student->messManagement->created_at)->format('Y-m-d') }}</span></div>
            </div>
        @else
            <p class="text-gray-500">No active mess subscription.</p>
        @endif
    </div>

    <!-- Fees -->
    <div class="bg-white p-6 rounded shadow">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Fees</h2>
            <a href="{{ route('admin.reports.fees') }}" class="text-sm text-blue-600 hover:text-blue-800">Go to Fee Report</a>
        </div>

        <!-- Totals summary -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="p-4 rounded bg-gray-50">
                <p class="text-gray-500 text-sm">Total Amount</p>
                <p class="text-xl font-semibold">Rs. {{ number_format($totalAmount) }}</p>
            </div>
            <div class="p-4 rounded bg-gray-50">
                <p class="text-gray-500 text-sm">Total Paid</p>
                <p class="text-xl font-semibold">Rs. {{ number_format($totalPaid) }}</p>
            </div>
            <div class="p-4 rounded bg-gray-50">
                <p class="text-gray-500 text-sm">Balance</p>
                <p class="text-xl font-semibold">Rs. {{ number_format($balance) }}</p>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold mb-2">Pending / Overdue</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="text-left p-2">Type</th>
                            <th class="text-left p-2">Amount</th>
                            <th class="text-left p-2">Due Date</th>
                            <th class="text-left p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingFees as $f)
                        <tr class="border-b">
                            <td class="p-2">{{ $f->fee_type }}</td>
                            <td class="p-2">{{ $f->amount }}</td>
                            <td class="p-2">{{ optional($f->due_date)->format('Y-m-d') }}</td>
                            <td class="p-2">{{ ucfirst($f->status) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center text-gray-500">No pending/overdue fees</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
{{-- 
        <div>
            <h3 class="font-semibold mb-2">Paid</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="text-left p-2">Type</th>
                            <th class="text-left p-2">Amount</th>
                            <th class="text-left p-2">Paid Amount</th>
                            <th class="text-left p-2">Paid Date</th>
                            <th class="text-left p-2">Receipt #</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($paidFees as $f)
                        <tr class="border-b">
                            <td class="p-2">{{ $f->fee_type }}</td>
                            <td class="p-2">{{ $f->amount }}</td>
                            <td class="p-2">{{ $f->paid_amount }}</td>
                            <td class="p-2">{{ optional($f->paid_date)->format('Y-m-d') }}</td>
                            <td class="p-2">{{ $f->receipt_number }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-3 text-center text-gray-500">No paid fees</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
</div>
@endsection