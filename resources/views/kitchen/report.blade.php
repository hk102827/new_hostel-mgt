{{-- resources/views/kitchen/report.blade.php --}}
@extends('layouts.admin')

@section('title','Kitchen Monthly Report')
@section('page-title','Kitchen Monthly Report')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between no-print">
        <form method="GET" action="{{ route('admin.kitchen.report') }}" class="flex gap-2 items-center">
            <select name="month" class="border rounded p-2">
                @for ($m=1; $m<=12; $m++)
                    <option value="{{ $m }}" @selected($m == $month)>{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                @endfor
            </select>
            <input type="number" name="year" value="{{ $year }}" class="border rounded p-2 w-24">
            <button class="px-4 py-2 bg-gray-800 text-white rounded">Apply</button>
            <a href="{{ route('admin.kitchen.export', ['from' => sprintf('%04d-%02d-01',$year,$month), 'to' => \Carbon\Carbon::create($year,$month,1)->endOfMonth()->format('Y-m-d')]) }}" class="px-4 py-2 bg-blue-600 text-white rounded">Export CSV</a>
            <button type="button" onclick="window.print()" class="px-4 py-2 bg-gray-200 rounded">Print</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Summary</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-4 rounded bg-gray-50">
                <p class="text-gray-500 text-sm">Month</p>
                <p class="text-lg font-semibold">{{ date('F', mktime(0,0,0,$month,1)) }} {{ $year }}</p>
            </div>
            <div class="p-4 rounded bg-gray-50">
                <p class="text-gray-500 text-sm">Total Expense</p>
                <p class="text-lg font-semibold">Rs. {{ number_format($total,2) }}</p>
            </div>
            <div class="p-4 rounded bg-gray-50">
                <p class="text-gray-500 text-sm">Number of Items Purchased</p>
                <p class="text-lg font-semibold">{{ $items->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">All Purchases ({{ date('F', mktime(0,0,0,$month,1)) }})</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="text-left p-2">Date</th>
                        <th class="text-left p-2">Item</th>
                        <th class="text-left p-2">Unit Price</th>
                        <th class="text-left p-2">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $p)
                    <tr class="border-b">
                        <td class="p-2">{{ optional($p->purchase_date)->format('d-m-Y') }}</td>
                        <td class="p-2">{{ $p->item_name }}</td>
                        <td class="p-2">{{ number_format($p->unit_price,2) }}</td>
                        <td class="p-2">{{ $p->notes }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection