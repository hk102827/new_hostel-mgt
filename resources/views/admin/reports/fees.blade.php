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
                @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.reports.fees.download', request()->query()) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-center w-full">Download CSV</a>
                @else
                <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-center w-full restricted-btn cursor-not-allowed">Download CSV</button>
                @endif  
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

<!-- Popup Modal -->
<div id="noAccessModal" 
     class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div id="noAccessBox" 
         class="bg-white p-6 rounded shadow-lg w-80 text-center">
        <h2 class="text-lg font-bold mb-4 text-red-600">Access Denied</h2>
        <p class="text-gray-700 mb-4">You do not have permission to perform this action.</p>
        <button onclick="closeNoAccessModal()" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            OK
        </button>
    </div>
</div>

<style>
/* Bounce animation */
@keyframes bounceIn {
  0%   { transform: scale(0.7); opacity: 0; }
  50%  { transform: scale(1.1); opacity: 1; }
  70%  { transform: scale(0.9); }
  100% { transform: scale(1); opacity: 1; }
}
.animate-bounce-in {
  animation: bounceIn 0.5s ease-out forwards;
}

/* Smooth fade out when closing */
@keyframes fadeOut {
  from { opacity: 1; transform: scale(1); }
  to   { opacity: 0; transform: scale(0.7); }
}
.animate-fade-out {
  animation: fadeOut 0.4s ease-in forwards;
}
</style>

<script>
    let autoHideTimeout;

    function showNoAccessModal() {
        const modal = document.getElementById('noAccessModal');
        const box = document.getElementById('noAccessBox');
        
        modal.classList.remove('hidden');
        box.classList.remove('animate-fade-out');
        void box.offsetWidth; // reset animation
        box.classList.add('animate-bounce-in');

        // Auto hide after 5 seconds
        clearTimeout(autoHideTimeout);
        autoHideTimeout = setTimeout(() => {
            closeNoAccessModal();
        }, 5000);
    }

    function closeNoAccessModal() {
        const modal = document.getElementById('noAccessModal');
        const box = document.getElementById('noAccessBox');

        // Add fade out animation
        box.classList.remove('animate-bounce-in');
        box.classList.add('animate-fade-out');

        // Wait for animation to finish, then hide
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 400);
        
        clearTimeout(autoHideTimeout); 
    }

    // Attach to all restricted buttons
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.restricted-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault(); 
                showNoAccessModal();
            });
        });
    });
</script>

@endsection