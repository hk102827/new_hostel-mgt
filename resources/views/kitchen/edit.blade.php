@extends('layouts.admin')

@section('title','Edit Purchase')
@section('page-title','Edit Purchase')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Edit Purchase</h2>
    <form method="POST" action="{{ route('admin.kitchen.update', $purchase->id) }}" class="grid grid-cols-1 md:grid-cols-6 gap-3">
        @csrf
        @method('PUT')

        <input type="date" name="purchase_date" value="{{ old('purchase_date', $purchase->purchase_date->format('Y-m-d')) }}" class="border rounded p-2" required>
        <input type="text" name="item_name" value="{{ old('item_name', $purchase->item_name) }}" class="border rounded p-2" required>
        <input type="text" name="category" value="{{ old('category', $purchase->category) }}" class="border rounded p-2">
        <input type="text" name="unit" value="{{ old('unit', $purchase->unit) }}" class="border rounded p-2">
        <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price', $purchase->unit_price) }}" class="border rounded p-2">
        <input type="number" step="0.01" name="total_cost" value="{{ old('total_cost', $purchase->total_cost) }}" class="border rounded p-2 md:col-span-2">
        <input type="text" name="notes" value="{{ old('notes', $purchase->notes) }}" class="border rounded p-2 md:col-span-3">
        
        <div class="md:col-span-6">
            <button class="px-4 py-2 bg-gray-800 text-white rounded">Update</button>
            <a href="{{ route('admin.kitchen.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
