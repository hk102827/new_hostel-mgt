{{-- resources/views/kitchen/index.blade.php --}}
@extends('layouts.admin')

@section('title','Kitchen Management')
@section('page-title','Kitchen Management')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Quick Add</h2>
        <form method="POST" action="{{ route('admin.kitchen.store') }}" class="grid grid-cols-1 md:grid-cols-6 gap-3">
            @csrf
            <input type="date" name="purchase_date" class="border rounded p-2" required>
            <input type="text" name="item_name" class="border rounded p-2" placeholder="Item (e.g. Vegetables)" required>
            <input type="text" name="category" class="border rounded p-2" placeholder="Category (optional)">
            <input type="number" step="0.01" name="quantity" class="border rounded p-2" placeholder="Qty">
            <input type="text" name="unit" class="border rounded p-2" placeholder="Unit (kg, ltr)">
            <input type="number" step="0.01" name="unit_price" class="border rounded p-2" placeholder="Unit Price">
            <input type="number" step="0.01" name="total_cost" class="border rounded p-2 md:col-span-2" placeholder="Total (auto if blank)">
            <input type="text" name="notes" class="border rounded p-2 md:col-span-3" placeholder="Notes">
            <div class="md:col-span-6">
                <button class="px-4 py-2 bg-gray-800 text-white rounded">Add</button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Purchases</h2>
            <a href="{{ route('admin.kitchen.report') }}" class="text-sm text-blue-600">Monthly Report</a>
        </div>

        <form method="GET" action="{{ route('admin.kitchen.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-3 mb-4">
            <input type="date" name="from" value="{{ request('from') }}" class="border rounded p-2">
            <input type="date" name="to" value="{{ request('to') }}" class="border rounded p-2">
            <select name="category" class="border rounded p-2">
                <option value="">All Categories</option>
                @foreach($categories as $c)
                    <option value="{{ $c }}" @selected(request('category')===$c)>{{ $c }}</option>
                @endforeach
            </select>
            <button class="px-4 py-2 bg-gray-200 rounded">Filter</button>
            <button type="button" onclick="window.location='{{ route('admin.kitchen.index') }}'" class="px-4 py-2 bg-gray-50 border rounded">Reset</button>
        </form>

        <div class="flex items-center justify-end mb-4 gap-2">
            <a href="{{ route('admin.kitchen.export', request()->only(['from','to','category'])) }}" class="px-4 py-2 bg-blue-600 text-white rounded">Export CSV</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="text-left p-2">Date</th>
                        <th class="text-left p-2">Item</th>
                        <th class="text-left p-2">Category</th>
                        <th class="text-left p-2">Qty</th>
                        <th class="text-left p-2">Unit</th>
                        <th class="text-left p-2">Unit Price</th>
                        <th class="text-left p-2">Total</th>
                        <th class="text-left p-2">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchases as $p)
                    <tr class="border-b">
                        <td class="p-2">{{ optional($p->purchase_date)->format('Y-m-d') }}</td>
                        <td class="p-2">{{ $p->item_name }}</td>
                        <td class="p-2">{{ $p->category }}</td>
                        <td class="p-2">{{ $p->quantity }}</td>
                        <td class="p-2">{{ $p->unit }}</td>
                        <td class="p-2">{{ number_format($p->unit_price,2) }}</td>
                        <td class="p-2 font-semibold">{{ number_format($p->total_cost,2) }}</td>
                        <td class="p-2">{{ $p->notes }}</td>
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
@endsection