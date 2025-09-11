@extends('layouts.admin')

@section('title', 'Mess Management')
@section('page-title', 'Mess Management')

@section('content')
<div class="container mx-auto">
 
    {{-- Filters --}}
    <div class="mb-4 flex space-x-4 justify-between items-center">
    <form method="GET" action="" class="flex space-x-3 mb-4">
        <select name="plan_type" class="border p-2 rounded">
            <option value="">All Plans</option>
            <option value="full_board" {{ request('plan_type')=='full_board' ? 'selected' : '' }}>Full board</option>
            <option value="breakfast_lunch" {{ request('plan_type')=='breakfast_lunch' ? 'selected' : '' }}>Breakfast + Lunch</option>
            <option value="lunch_dinner" {{ request('plan_type')=='lunch_dinner' ? 'selected' : '' }}>Lunch + Dinner</option>
            <option value="lunch_only" {{ request('plan_type')=='lunch_only' ? 'selected' : '' }}>Lunch only</option>
        </select>
        <select name="status" class="border p-2 rounded">
            <option value="">All Status</option>
            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="suspended" {{ request('status')=='suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>
        <a href="{{ route('admin.mess.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Add New</a>
  
</div>

  <table class="min-w-full bg-white border rounded shadow">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-6 py-3 text-left">Student</th>
            <th class="px-6 py-3 text-left">Mess Plan</th>
            <th class="px-6 py-3 text-left">Monthly Fee</th>
            <th class="px-6 py-3 text-left">Start</th>
            <th class="px-6 py-3 text-left">End</th>
            <th class="px-6 py-3 text-left">Status</th>
            <th class="px-6 py-3 text-left">Actions</th> <!-- 👈 new column -->
        </tr>
    </thead>
    <tbody>
        @forelse($records as $row)
        <tr class="border-t">
            <td class="px-6 py-3">{{ optional($row->student)->name }} (ID: {{ $row->student_id }})</td>
            <td class="px-6 py-3">{{ str_replace('_',' ', ucfirst($row->plan_type)) }}</td>
            <td class="px-6 py-3">{{ number_format($row->monthly_fee, 2) }}</td>
            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($row->start_date)->format('Y-m-d') }}</td>
            <td class="px-6 py-3">{{ $row->end_date ? \Carbon\Carbon::parse($row->end_date)->format('Y-m-d') : '-' }}</td>
            <td class="px-6 py-3">
                <span class="px-2 py-1 rounded text-white {{ $row->status=='active' ? 'bg-green-600' : ($row->status=='suspended' ? 'bg-yellow-600' : 'bg-gray-500') }}">
                    {{ ucfirst($row->status) }}
                </span>
            </td>
            <td class="px-6 py-3">
                <div class="flex space-x-2">
                        <a href="{{ route('admin.mess.edit', $row->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('admin.mess.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Delete this record?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                    </form>
                  
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center py-4">No records found</td>
        </tr>
        @endforelse
    </tbody>
</table>

</div>

@endsection