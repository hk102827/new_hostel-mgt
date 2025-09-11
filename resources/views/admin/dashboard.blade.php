{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
    <div class="space-y-6">

        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-3 sm:p-3 md:p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                <div>
                    <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold">
                        Welcome back, {{ auth()->user()->name }}!
                    </h2>
                    <p class="text-xs sm:text-sm text-blue-100 mt-0.5">{{ date('l, F j, Y') }}</p>
                </div>
                <div class="flex items-center space-x-1">
                    <i class="fas fa-user-shield text-lg sm:text-xl text-blue-200"></i>
                    <span class="text-xs sm:text-sm text-blue-100">Administrator</span>
                </div>
            </div>
        </div>

       <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-4 sm:gap-6">

            <a href="{{ route('admin.students.create') }}"
                class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow border-l-4 border-blue-500">
                <div class="flex items-center">
                    <i class="fas fa-user-plus text-blue-500 text-2xl mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Add Student</p>
                        <p class="text-sm text-gray-600">Quick admission</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.rooms.create') }}"
                class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow border-l-4 border-green-500">
                <div class="flex items-center">
                    <i class="fas fa-plus-circle text-green-500 text-2xl mr-3"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Add Room</p>
                        <p class="text-sm text-gray-600">Create new room</p>
                    </div>
                </div>
            </a>
            {{-- Collect Fee (Only Admin) --}}
            @role('admin')
                <a href="{{ route('admin.fees.create') }}"
                    class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <i class="fas fa-receipt text-purple-500 text-2xl mr-3"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Collect Fee</p>
                            <p class="text-sm text-gray-600">Payment entry</p>
                        </div>
                    </div>
                </a>
            @endrole

            @role('admin')
                <a href="{{ route('admin.reports.index') }}"
                    class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow border-l-4 border-orange-500">
                    <div class="flex items-center">
                        <i class="fas fa-file-export text-orange-500 text-2xl mr-3"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Generate Report</p>
                            <p class="text-sm text-gray-600">Export data</p>
                        </div>
                    </div>
                </a>
            @endrole

        </div>




        <!-- Enhanced Stats Cards with Trends -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-blue-500 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100">Total Students</p>
                            <p class="text-3xl font-bold">{{ $stats['total_students'] }}</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-arrow-up text-sm text-blue-200 mr-1"></i>
                                <span class="text-sm text-blue-200">+5 this month</span>
                            </div>
                        </div>
                        <i class="fas fa-users text-4xl text-blue-200"></i>
                    </div>
                </div>
                @role('admin')
                    <div class="p-4 bg-blue-50">
                        <a href="{{ route('admin.students.index') }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View All Students →
                        </a>
                    </div>
                @endrole
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-green-500 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Room Occupancy</p>
                            <p class="text-3xl font-bold">{{ $stats['occupied_rooms'] }}/{{ $stats['total_rooms'] }}</p>
                            <div class="flex items-center mt-2">
                                <div class="bg-green-300 h-2 rounded-full w-full">
                                    <div class="bg-white h-2 rounded-full"
                                        style="width: {{ ($stats['occupied_rooms'] / $stats['total_rooms']) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <i class="fas fa-home text-4xl text-green-200"></i>
                    </div>
                </div>
                @role('admin')
                    <div class="p-4 bg-green-50">
                        <a href="{{ route('admin.rooms.index') }}"
                            class="text-green-600 hover:text-green-800 text-sm font-medium">
                            Manage Rooms →
                        </a>
                    </div>
                @endrole
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-purple-500 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100">Academy Students</p>
                            <p class="text-3xl font-bold">{{ $stats['academy_students'] }}</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-graduation-cap text-sm text-purple-200 mr-1"></i>
                                <span class="text-sm text-purple-200">Active learners</span>
                            </div>
                        </div>
                        <i class="fas fa-book text-4xl text-purple-200"></i>
                    </div>
                </div>
                @role('admin')
                    <div class="p-4 bg-purple-50">
                        <a href="{{ route('admin.academy.index') }}"
                            class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                            View Academy →
                        </a>
                    </div>
                @endrole
            </div>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-orange-500 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100">Mess Members</p>
                            <p class="text-3xl font-bold">{{ $stats['mess_members'] }}</p>
                            <div class="flex items-center mt-2">
                                <i class="fas fa-check-circle text-sm text-orange-200 mr-1"></i>
                                <span class="text-sm text-orange-200">Active subscriptions</span>
                            </div>
                        </div>
                        <i class="fas fa-utensils text-4xl text-orange-200"></i>
                    </div>
                </div>
                @role('admin')
                    <div class="p-4 bg-orange-50">
                        <a href="{{ route('admin.mess.index') }}"
                            class="text-orange-600 hover:text-orange-800 text-sm font-medium">
                            Manage Mess →
                        </a>
                    </div>
                @endrole
            </div>
        </div>

        <!-- Financial Overview -->
        @role('admin')
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="bg-red-500 text-white p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-red-100">Pending Fees</p>
                                <p class="text-3xl font-bold">Rs. {{ number_format($stats['pending_fees']) }}</p>
                                <div class="flex items-center mt-2">
                                    <i class="fas fa-clock text-sm text-red-200 mr-1"></i>
                                    <span class="text-sm text-red-200">{{ $stats['pending_count'] ?? 0 }} students</span>
                                </div>
                            </div>
                            <i class="fas fa-exclamation-triangle text-4xl text-red-200"></i>
                        </div>
                    </div>
                    <div class="p-4 bg-red-50">
                        <a href="{{ route('admin.fees.index') }}?status[]=pending&status[]=partial"
                            class="text-red-600 hover:text-red-800 text-sm font-medium">
                            View Pending & Partial →
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="bg-emerald-500 text-white p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-emerald-100">Monthly Revenue</p>
                                <p class="text-3xl font-bold">Rs. {{ number_format($stats['monthly_revenue']) }}</p>
                                <div class="flex items-center mt-2">
                                    <i class="fas fa-calendar text-sm text-emerald-200 mr-1"></i>
                                    <span class="text-sm text-emerald-200">{{ date('F Y') }}</span>
                                </div>
                            </div>
                            <i class="fas fa-chart-line text-4xl text-emerald-200"></i>
                        </div>
                    </div>
                    <div class="p-4 bg-emerald-50">
                        <a href="{{ route('admin.reports.index') }}?type=revenue"
                            class="text-emerald-600 hover:text-emerald-800 text-sm font-medium">
                            View Report →
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="bg-indigo-500 text-white p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-indigo-100">Collection Rate</p>
                                <p class="text-3xl font-bold">{{ $stats['collection_rate'] }}%</p>
                                <div class="flex items-center mt-2">
                                    <div class="bg-indigo-300 h-2 rounded-full w-full">
                                        <div class="bg-white h-2 rounded-full"
                                            style="width: {{ $stats['collection_rate'] }}%"></div>
                                    </div>
                                </div>

                            </div>
                            <i class="fas fa-percentage text-4xl text-indigo-200"></i>
                        </div>
                    </div>
                    <div class="p-4 bg-indigo-50">
                        <a href="{{ route('admin.fees.index') }}"
                            class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            Fee Management →
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-4 mt-6">
                <h3 class="text-lg font-bold mb-4">Last 6 Months Overview</h3>
                <canvas id="revenueChart" height="80"></canvas>
            </div>
        @endrole

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-4 sm:gap-6">

            <!-- Recent Admissions - Enhanced -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="p-6 border-b bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold flex items-center">
                            <i class="fas fa-user-plus text-blue-500 mr-2"></i>
                            Recent Admissions
                        </h3>
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                            {{ count($recent_admissions) }} new
                        </span>
                    </div>
                </div>
                <div class="p-6 max-h-80 overflow-y-auto">
                    @forelse($recent_admissions as $student)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $student->name }}</p>
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-door-open mr-1"></i>
                                        {{ $student->roomAssignment ? 'Room: ' . $student->roomAssignment->room->room_number : 'No room assigned' }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($student->admission_date)->diffForHumans() }}
                                </span>
                                <div>
                                    <a href="{{ route('admin.students.show', $student->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-xs">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-users text-3xl mb-2"></i>
                            <p>No recent admissions</p>
                        </div>
                    @endforelse
                </div>
                <div class="p-4 bg-gray-50 border-t">
                    <a href="{{ route('admin.students.index') }}"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center justify-center">
                        <i class="fas fa-arrow-right mr-1"></i> View All Students
                    </a>
                </div>
            </div>

            <!-- Pending Payments - Enhanced -->
            @role('admin')
                <div class="bg-white rounded-lg shadow-lg">
                    <div class="p-6 border-b bg-gray-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold flex items-center">
                                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                                Pending Payments
                            </h3>
                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                {{ count($pending_payments) }} pending
                            </span>
                        </div>
                    </div>
                    <div class="p-6 max-h-80 overflow-y-auto">
                        @forelse($pending_payments as $student)
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $student->name }}</p>
                                        <p class="text-sm text-red-600 font-semibold">
                                            <i class="fas fa-money-bill-wave mr-1"></i>
                                            Rs. {{ number_format($student->pending_amount) }} pending
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('admin.student.details', ['id' => $student->id]) }}"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 transition-colors">
                                        Collect Fee
                                    </a>
                                    <div class="mt-1">
                                        <span class="text-xs text-gray-500">Overdue</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-check-circle text-3xl mb-2 text-green-500"></i>
                                <p>All payments up to date!</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="p-4 bg-gray-50 border-t">
                        <a href="{{ route('admin.fees.index') }}"
                            class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center justify-center">
                            <i class="fas fa-arrow-right mr-1"></i> Fee Management
                        </a>
                    </div>
                </div>
            @endrole

            <!-- System Alerts & Notifications -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-bell text-yellow-500 mr-2"></i>
                        System Alerts
                    </h3>
                </div>
                <div class="p-6 max-h-80 overflow-y-auto">
                    <!-- Room Capacity Alert -->
                    @if ($stats['occupied_rooms'] / $stats['total_rooms'] > 0.9)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-warning text-yellow-500 mr-2"></i>
                                <div>
                                    <p class="font-medium text-yellow-800">High Occupancy</p>
                                    <p class="text-sm text-yellow-700">Rooms are
                                        {{ round(($stats['occupied_rooms'] / $stats['total_rooms']) * 100) }}% full</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Fee Collection Alert -->
                    @if ($stats['pending_fees'] > 50000)
                        <div class="bg-red-50 border-l-4 border-red-400 p-3 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-money-bill-wave text-red-500 mr-2"></i>
                                <div>
                                    <p class="font-medium text-red-800">High Pending Amount</p>
                                    <p class="text-sm text-red-700">Rs. {{ number_format($stats['pending_fees']) }}
                                        pending collection</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Low Occupancy Alert -->
                    @if ($stats['occupied_rooms'] / $stats['total_rooms'] < 0.5)
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-3 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                <div>
                                    <p class="font-medium text-blue-800">Low Occupancy</p>
                                    <p class="text-sm text-blue-700">Consider marketing campaigns</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Maintenance Reminder -->
                    <div class="bg-green-50 border-l-4 border-green-400 p-3">
                        <div class="flex items-center">
                            <i class="fas fa-tools text-green-500 mr-2"></i>
                            <div>
                                <p class="font-medium text-green-800">Monthly Maintenance</p>
                                <p class="text-sm text-green-700">Schedule room inspections</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <!-- Real-time Clock Script -->
    <script>
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
        }

        // Update time every second
        setInterval(updateTime, 1000);
        updateTime(); // Initial call
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($stats['last6Months']->pluck('month')),
                datasets: [{
                        label: 'Revenue',
                        data: @json($stats['last6Months']->pluck('revenue')),
                        backgroundColor: 'rgba(16, 185, 129, 0.7)', // green
                    },
                    {
                        label: 'Pending',
                        data: @json($stats['last6Months']->pluck('pending')),
                        backgroundColor: 'rgba(239, 68, 68, 0.7)', // red
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let value = context.raw;
                                // ✅ No decimals, proper Rs format
                                return context.dataset.label + ': Rs. ' + Math.round(value).toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                // ✅ Y-axis formatting
                                return 'Rs. ' + Math.round(value).toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>

   

@endsection
