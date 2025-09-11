{{-- resources/views/kitchen/index.blade.php --}}
@extends('layouts.admin')

@section('title','Kitchen Management')
@section('page-title','daily expances')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Quick Add</h2>
        <form method="POST" action="{{ route('admin.kitchen.store') }}" class="grid grid-cols-1 md:grid-cols-6 gap-3">
            @csrf
            <input type="date" name="purchase_date" class="border rounded p-2" required>
            <input type="text" name="item_name" class="border rounded p-2" placeholder="Item (e.g. Vegetables)" required>
            <input type="number" step="0.01" name="unit_price" class="border rounded p-2" placeholder="Unit Price">
           
            <input type="text" name="notes" class="border rounded p-2 md:col-span-3" placeholder="Notes">
            <div class="md:col-span-6">
                @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                    <button class="px-4 py-2 bg-gray-800 text-white rounded">Add</button>
                @else
                    <button class="px-4 py-2 bg-gray-800 text-white rounded restricted-btn cursor-not-allowed">Add</button>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Purchases</h2>
            @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.kitchen.report') }}" class="text-sm text-blue-600">Monthly Report</a>
            @else
            <button class="text-sm text-blue-600 restricted-btn cursor-not-allowed">Monthly Report</button>
            @endif
        </div>

        <form method="GET" action="{{ route('admin.kitchen.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-3 mb-4">
            <select name="item" class="border rounded p-2">
                <option value="">All Items</option>
                @foreach($items as $c)
                    <option value="{{ $c }}" @selected(request('item')===$c)>{{ $c }}</option>
                @endforeach
            </select>
            <button class="px-4 py-2 bg-gray-200 rounded">Filter</button>
            <button type="button" onclick="window.location='{{ route('admin.kitchen.index') }}'" class="px-4 py-2 bg-gray-50 border rounded">Reset</button>
        </form>

        <div class="flex items-center justify-end mb-4 gap-2">
            @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.kitchen.export', request()->only(['from','to','category'])) }}" class="px-4 py-2 bg-blue-600 text-white rounded">Export CSV</a>
            @else
            <button class="px-4 py-2 bg-blue-600 text-white rounded restricted-btn cursor-not-allowed">Export CSV</button>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="text-left p-2">Date</th>
                        <th class="text-left p-2">Item</th>
                        <th class="text-left p-2">Unit Price</th>
                        <th class="text-left p-2">Notes</th>
                        <th class="text-left p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $p)
                    <tr class="border-b">
                        <td class="p-2">{{ optional($p->purchase_date)->format('d-m-Y') }}</td>
                        <td class="p-2">{{ $p->item_name }}</td>
                        <td class="p-2">{{ number_format($p->unit_price) }}</td>
                        <td class="p-2">{{ $p->notes }}</td>
                        <td class="p-2 flex gap-2">
                            @if(!auth()->user()->hasRole('super-admin') && !auth()->user()->hasRole('admin'))
                                <button class="restricted-btn px-3 py-1 bg-yellow-500 text-white rounded cursor-not-allowed">Edit</button>
                            @else
                            <a href="{{ route('admin.kitchen.edit', $p->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            @endif
                            @if(!auth()->user()->hasRole('super-admin') && !auth()->user()->hasRole('admin'))
                                <button class="restricted-btn px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                            <form method="POST" action="{{ route('admin.kitchen.destroy', $p->id) }}" onsubmit="return confirm('Delete this record?');">
                                @csrf
                                @method('DELETE')
                            </form>
                            @else
                            <button class="px-3 py-1 bg-red-600 text-white rounded cursor-not-allowed">Delete</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-3 text-center text-gray-500">No records</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $purchases->links() }}</div>
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