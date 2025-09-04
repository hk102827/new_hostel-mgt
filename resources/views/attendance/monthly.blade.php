@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4">
    <!-- Header -->
    <div class="bg-white shadow-md rounded-lg mb-6">
        <div class="bg-blue-600 text-white p-4 rounded-t-lg">
            <h3 class="text-xl font-semibold flex items-center">
                <i class="fas fa-calendar-check mr-3"></i>
                Monthly Attendance: {{ $month }}
            </h3>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="bg-white shadow-md rounded-lg mb-6 p-6 no-print">
        <form method="GET" class="flex flex-wrap items-end gap-4">
            <div class="w-48">
                <label for="month" class="block text-sm font-medium text-gray-700 mb-2">Select Month</label>
                <input type="month" name="month" id="month" value="{{ $month }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Load
                </button>
            </div>
        </form>
   

    <!-- Export Options -->
    <div class="bg-white shadow-md rounded-lg mb-6 p-6">
        <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
            <i class="fas fa-download mr-2"></i>
            Export Options
        </h4>
        <div class="flex flex-wrap gap-3">
            <!-- Excel Export -->
            <a href="{{ route('admin.attendance.export.excel', ['month' => $month]) }}"
            class="bg-green-50 text-green-700 border border-green-200 px-4 py-2 rounded-md hover:bg-green-100 
                    focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center transition-colors">
                <i class="fas fa-file-excel mr-2"></i>
                Export to Excel
            </a>

            <!-- PDF Export -->
            <a href="{{ route('admin.attendance.export.pdf', ['month' => $month]) }}"
            class="bg-red-50 text-red-700 border border-red-200 px-4 py-2 rounded-md hover:bg-red-100 
                    focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 flex items-center transition-colors">
                <i class="fas fa-file-pdf mr-2"></i>
                Export to PDF
            </a>

            <!-- Print -->
            <button onclick="window.print()" 
                    class="bg-blue-50 text-blue-700 border border-blue-200 px-4 py-2 rounded-md hover:bg-blue-100 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center transition-colors">
                <i class="fas fa-print mr-2"></i> Print Report
            </button>
        </div>

    </div>

     </div>

    <!-- Attendance Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium uppercase tracking-wider">
                            <i class="fas fa-calendar-day mr-2"></i>Date
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium uppercase tracking-wider">
                            <i class="fas fa-clock mr-2"></i>Session
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium uppercase tracking-wider">
                            <i class="fas fa-tag mr-2"></i>Type
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium uppercase tracking-wider">
                            <i class="fas fa-user mr-2"></i>Name
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium uppercase tracking-wider">
                            <i class="fas fa-check-circle mr-2"></i>Status
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($records as $r)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $r->date->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $r->session }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ class_basename($r->attendable_type) }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $r->attendable->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($r->status == 'Present') bg-green-100 text-green-800 
                                    @elseif($r->status == 'Absent') bg-red-100 text-red-800 
                                    @else bg-yellow-100 text-yellow-800 
                                    @endif">
                                    {{ $r->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Summary Stats (Optional) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
        <div class="bg-white border-l-4 border-green-500 shadow-md rounded-lg p-4 text-center">
            <h4 class="text-2xl font-bold text-green-600">{{ $records->where('status', 'Present')->count() }}</h4>
            <p class="text-sm text-gray-600">Present</p>
        </div>
        <div class="bg-white border-l-4 border-red-500 shadow-md rounded-lg p-4 text-center">
            <h4 class="text-2xl font-bold text-red-600">{{ $records->where('status', 'Absent')->count() }}</h4>
            <p class="text-sm text-gray-600">Absent</p>
        </div>
        <div class="bg-white border-l-4 border-yellow-500 shadow-md rounded-lg p-4 text-center">
            <h4 class="text-2xl font-bold text-yellow-600">{{ $records->where('status', 'Late')->count() }}</h4>
            <p class="text-sm text-gray-600">Late</p>
        </div>
        <div class="bg-white border-l-4 border-blue-500 shadow-md rounded-lg p-4 text-center">
            <h4 class="text-2xl font-bold text-blue-600">{{ $records->count() }}</h4>
            <p class="text-sm text-gray-600">Total</p>
        </div>
    </div>
</div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const month = '{{ $month }}';
        
        // Excel export
        const excelBtn = document.querySelector('[data-export="excel"]');
        if (excelBtn) {
            excelBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Excel export clicked'); // Debug log
                window.location.href = `{{ route('admin.attendance.export.excel') }}?month=${month}`;
            });
        }

        // PDF export  
        const pdfBtn = document.querySelector('[data-export="pdf"]');
        if (pdfBtn) {
            pdfBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('PDF export clicked'); // Debug log
                window.location.href = `{{ route('admin.attendance.export.pdf') }}?month=${month}`;
            });
        }

        // Print functionality
        const printBtn = document.querySelector('[data-export="print"]');
        if (printBtn) {
            printBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Print clicked'); // Debug log
                window.print();
            });
        }
    });
</script>
@endpush

@endsection