
{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')

                            
<div class="space-y-6">
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100">Total Students</p>
                    <p class="text-3xl font-bold">{{ $stats['total_students'] }}</p>
                </div>
                <i class="fas fa-users text-4xl text-blue-200"></i>
            </div>
        </div>
        
        <div class="bg-green-500 text-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100">Occupied Rooms</p>
                    <p class="text-3xl font-bold">{{ $stats['occupied_rooms'] }}/{{ $stats['total_rooms'] }}</p>
                </div>
                <i class="fas fa-home text-4xl text-green-200"></i>
            </div>
        </div>
        
        <div class="bg-purple-500 text-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100">Academy Students</p>
                    <p class="text-3xl font-bold">{{ $stats['academy_students'] }}</p>
                </div>
                <i class="fas fa-book text-4xl text-purple-200"></i>
            </div>
        </div>
        
        <div class="bg-orange-500 text-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100">Mess Members</p>
                    <p class="text-3xl font-bold">{{ $stats['mess_members'] }}</p>
                </div>
                <i class="fas fa-utensils text-4xl text-orange-200"></i>
            </div>
        </div>
    </div>

    <!-- Revenue Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-red-500 text-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100">Pending Fees</p>
                    <p class="text-3xl font-bold">Rs. {{ number_format($stats['pending_fees']) }}</p>
                </div>
                <i class="fas fa-exclamation-triangle text-4xl text-red-200"></i>
            </div>
        </div>
        
        <div class="bg-emerald-500 text-white p-6 rounded-lg shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100">Monthly Revenue</p>
                    <p class="text-3xl font-bold">Rs. {{ number_format($stats['monthly_revenue']) }}</p>
                </div>
                <i class="fas fa-chart-line text-4xl text-emerald-200"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Admissions -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Recent Admissions</h3>
            </div>
            <div class="p-6">
                @foreach($recent_admissions as $student)
                <div class="flex items-center justify-between py-2">
                    <div>
                        <p class="font-medium">{{ $student->name }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $student->roomAssignment ? 'Room: ' . $student->roomAssignment->room->room_number : 'No room assigned' }}
                        </p>
                    </div>
<span class="text-sm text-gray-500">
    {{ \Carbon\Carbon::parse($student->admission_date)->diffForHumans() }}
</span>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Pending Payments -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Pending Payments</h3>
            </div>
            <div class="p-6">
                @foreach($pending_payments as $student)
                <div class="flex items-center justify-between py-2">
                    <div>
                        <p class="font-medium">{{ $student->name }}</p>
                        <p class="text-sm text-red-600">
                            Rs. {{ number_format($student->pendingFees->sum('amount')) }} pending
                        </p>
                    </div>
                    <a href="{{ route('admin.students.show', $student) }}" 
                       class="text-blue-600 hover:text-blue-800 text-sm">
                        View Details
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection