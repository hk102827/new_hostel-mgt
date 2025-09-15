@extends('layouts.admin')

@section('title', 'Fee Details')
@section('page-title', 'Fee Collection Details')

@section('content')
<div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6 rounded-t-lg">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold">Fee Receipt</h2>
                <p class="text-blue-100 mt-1">{{ $fee->receipt_number ? 'Receipt #: ' . $fee->receipt_number : 'System Generated' }}</p>
            </div>
            <div class="text-right">
                <div class="text-lg font-semibold">{{ $fee->fees_month }}</div>
                <div class="text-sm text-blue-100">{{ \Carbon\Carbon::parse($fee->date)->format('d M Y') }}</div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-8">
        <!-- Student Information Card -->
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-start justify-between">
                <div class="flex items-center space-x-4">
                    @if($fee->student->photo)
                        <img src="{{ Storage::url($fee->student->photo) }}" 
                             alt="Student Photo" 
                             class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center border-4 border-white shadow-lg">
                            <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $fee->student->name }}</h3>
                        <p class="text-gray-600">Guardian: {{ $fee->student->father_name ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="text-right">
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                        @if($fee->status == 'paid') bg-green-100 text-green-800
                        @elseif($fee->status == 'partial') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($fee->status) }}
                    </span>
                </div>
            </div>
            
            <!-- Additional Student Details -->
            <div class="grid grid-cols-3 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4 pt-4 border-t border-gray-200">
                <div>
                    <span class="text-sm text-gray-500">Phone:</span>
                    <p class="font-medium">{{ $fee->student->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Email:</span>
                    <p class="font-medium">{{ $fee->student->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Station:</span>
                    <p class="font-medium">{{ $fee->student->station ?? 'N/A' }}</p>
                </div>
                {{-- <div>
                    <span class="text-sm text-gray-500">Department:</span>
                    <p class="font-medium">{{ $fee->student->department ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Specialization:</span>
                    <p class="font-medium">{{ $fee->student->specialization ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Job Type:</span>
                    <p class="font-medium">{{ $fee->student->job_type ?? 'N/A' }}</p>
                </div> --}}
            </div>
        </div>

        <!-- Fee Details Table -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                <h4 class="text-lg font-semibold text-gray-800">Fee Breakdown</h4>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sr.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Particulars</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php
                            $feeItems = [
                                ['label' => 'Monthly Fee', 'amount' => $fee->monthly_fee],
                                ['label' => 'Admission Fee', 'amount' => $fee->admission_fee],
                                ['label' => 'Registration Fee', 'amount' => $fee->registration_fee],
                                ['label' => 'Hostel Fee', 'amount' => $fee->hostel_fee],
                                ['label' => 'Previous Month Fee', 'amount' => $fee->previous_month_fee],
                                ['label' => 'Other Fee', 'amount' => $fee->other_fee],
                            ];
                            $srNo = 1;
                        @endphp
                        
                        @foreach($feeItems as $item)
                            @if($item['amount'] > 0)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $srNo++ }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['label'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">{{ number_format($item['amount'], 2) }}</td>
                                </tr>
                            @endif
                        @endforeach
                        
                        @if($fee->discount > 0)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $srNo++ }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">Discount</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 text-right">-{{ number_format($fee->discount, 2) }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Amount -->
            <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600">Total Amount</p>
                        <p class="text-2xl font-bold text-blue-900">Rs. {{ number_format($fee->total_amount, 2) }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Deposit/Paid -->
            <div class="bg-green-50 rounded-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600">Amount Paid</p>
                        <p class="text-2xl font-bold text-green-900">Rs. {{ number_format($fee->deposit, 2) }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Due Balance -->
            <div class="@if($fee->due_balance > 0) bg-red-50 border-red-500 @elseif($fee->due_balance < 0) bg-purple-50 border-purple-500 @else bg-gray-50 border-gray-500 @endif rounded-lg p-6 border-l-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium @if($fee->due_balance > 0) text-red-600 @elseif($fee->due_balance < 0) text-purple-600 @else text-gray-600 @endif">
                            @if($fee->due_balance > 0) 
                                Due Balance
                            @elseif($fee->due_balance < 0) 
                                Excess Payment
                            @else 
                                Balance
                            @endif
                        </p>
                        <p class="text-2xl font-bold @if($fee->due_balance > 0) text-red-900 @elseif($fee->due_balance < 0) text-purple-900 @else text-gray-900 @endif">
                            Rs. {{ number_format(abs($fee->due_balance), 2) }}
                        </p>
                    </div>
                    <div class="p-3 @if($fee->due_balance > 0) bg-red-100 @elseif($fee->due_balance < 0) bg-purple-100 @else bg-gray-100 @endif rounded-full">
                        @if($fee->due_balance > 0)
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        @elseif($fee->due_balance < 0)
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12z"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>

     <!-- Payment Information -->
<div class="bg-gray-50 rounded-lg p-2">
    <h4 class="text-lg font-semibold text-gray-800 mb-2">Payment Information</h4>
    <div class="grid grid-cols-3 md:grid-cols-2 lg:grid-cols-4 gap-4 payment-info-grid">
        <div>
            <span class="text-sm text-gray-500">Payment Method:</span>
            <p class="font-medium">{{ $fee->payment_method ? ucfirst($fee->payment_method) : 'Not Specified' }}</p>
        </div>
        <div>
            <span class="text-sm text-gray-500">Receipt Number:</span>
            <p class="font-medium">{{ $fee->receipt_number ?? 'Not Available' }}</p>
        </div>
        <div>
            <span class="text-sm text-gray-500">Payment Date:</span>
            <p class="font-medium">{{ \Carbon\Carbon::parse($fee->date)->format('d M Y') }}</p>
        </div>
        <div>
            <span class="text-sm text-gray-500">Status:</span>
            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                @if($fee->status == 'paid') bg-green-100 text-green-800
                @elseif($fee->status == 'partial') bg-yellow-100 text-yellow-800
                @else bg-red-100 text-red-800
                @endif">
                {{ ucfirst($fee->status) }}
            </span>
        </div>
    </div>
</div>


        <!-- Notes Section -->
        @if($fee->notes)
        <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-500">
            <h4 class="text-lg font-semibold text-blue-800 mb-2">Notes</h4>
            <p class="text-gray-700">{{ $fee->notes }}</p>
        </div>
        @endif

        <!-- Record Information -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-2">Record Information</h4>
            <div class="grid grid-cols-3 md:grid-cols-2 gap-4">
                <div>
                    <span class="text-sm text-gray-500">Created On:</span>
                    <p class="font-medium">{{ $fee->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <div>
                    <span class="text-sm text-gray-500">Last Updated:</span>
                    <p class="font-medium">{{ $fee->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.fees.index') }}" 
               class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 font-medium">
                Back to List
            </a>
            <a href="{{ route('admin.fees.edit', $fee->id) }}" 
               class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                Edit Record
            </a>
            <button onclick="window.print()" 
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium">
                Print Receipt
            </button>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
@media print {
    /* Reset page settings */
    @page {
        size: A4;
        margin: 0.5in;
    }
    
    body * {
        visibility: hidden;
    }
       img {
        max-width: 170px !important;  /* apne hisaab se badhao (100px → 150px / 200px) */
        height: auto !important;
    }
    
    .max-w-6xl, .max-w-6xl * {
        visibility: visible;
    }
    
     .max-w-6xl {
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%) scale(0.85); /* ✅ Center horizontally */
        transform-origin: top center; /* ✅ Start from center */
        width: 100% !important;
        max-width: 800px !important; /* Optional: fix max width */
        margin: 0 auto !important;
        padding: 0 !important;
    }
    
    /* Hide action buttons when printing */
    .flex.justify-center.space-x-4 {
        display: none !important;
    }
    
    /* Reduce spacing to fit on one page */
    .space-y-8 > * + * {
        margin-top: 1rem !important;
    }
    
    .p-6 {
        padding: 0.75rem !important;
    }
    
    .py-3 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }
    
    .py-4 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }
    
    .mb-4 {
        margin-bottom: 0.5rem !important;
    }
    
    .mb-8 {
        margin-bottom: 1rem !important;
    }
    
    .gap-6 {
        gap: 0.75rem !important;
    }
    
    .gap-4 {
        gap: 0.5rem !important;
    }
    
    /* Make text smaller for better fit */
    .text-3xl {
        font-size: 1.5rem !important;
        line-height: 2rem !important;
    }
    
    .text-2xl {
        font-size: 1.25rem !important;
        line-height: 1.75rem !important;
    }
    
    .text-xl {
        font-size: 1.125rem !important;
        line-height: 1.75rem !important;
    }
    
    .text-lg {
        font-size: 1rem !important;
        line-height: 1.5rem !important;
    }
    
    /* Reduce photo size */
    .w-16.h-16 {
        width: 3rem !important;
        height: 3rem !important;
    }
    
    /* Compact grid layouts */
    .grid {
        display: grid !important;
    }
    
    .grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
    }
    
    .md\\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
    
    .md\\:grid-cols-3 {
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    }
    
    .lg\\:grid-cols-3 {
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    }
    
    .lg\\:grid-cols-4 {
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    }
    
    /* Adjust colors for print */
    .bg-gradient-to-r {
        background: #1d4ed8 !important;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }
    
    .text-white {
        color: white !important;
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }
    
    /* Ensure colored backgrounds print */
    .bg-blue-50, .bg-green-50, .bg-red-50, .bg-purple-50, .bg-gray-50 {
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }
    
    /* Ensure borders print */
    .border, .border-gray-200, .border-t, .border-l-4 {
        -webkit-print-color-adjust: exact;
        color-adjust: exact;
    }
    
    /* Force page break prevention */
    .bg-gray-50.rounded-lg,
    .bg-white.rounded-lg,
    .bg-blue-50.rounded-lg,
    .bg-green-50.rounded-lg,
    .bg-red-50.rounded-lg,
    .bg-purple-50.rounded-lg {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    
    /* Compact table */
    table {
        font-size: 0.875rem !important;
    }
    
    .px-6 {
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
    }

        .payment-info-grid {
        display: flex !important;     /* ✅ sab ek line me */
        justify-content: space-between;
        flex-wrap: nowrap !important; /* ✅ wrap na ho */
    }
        .payment-info-grid > div {
        flex: 1;
        padding-right: 15px;
        white-space: nowrap;          /* ✅ text next line na jaye */
    }
}
</style>

@endsection