{{-- resources/views/admin/reports/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Reports')
@section('page-title', 'Reports')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Download CSV Reports</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('admin.reports.download', ['type' => 'students']) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">Students CSV</a>
            <a href="{{ route('admin.reports.download', ['type' => 'rooms']) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-center">Rooms CSV</a>
            <a href="{{ route('admin.reports.download', ['type' => 'fees']) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-center">Fees CSV</a>
        </div>
        <div class="mt-6">
            <a href="{{ route('admin.reports.fees') }}" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Go to Fee Report (filters + CSV)</a>
        </div>
    </div>
</div>
@endsection