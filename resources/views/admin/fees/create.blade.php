@extends('layouts.admin')

@section('title', 'Fees Collection')
@section('page-title', 'Fees Collection')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Fees Collection</h2>
        <div class="flex justify-center items-center gap-4 mt-2">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-blue-500 rounded"></div>
                <span class="text-sm text-gray-600">Required*</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-gray-400 rounded"></div>
                <span class="text-sm text-gray-600">Optional</span>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.fees.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Search Student Section -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <!-- Student Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Registration <span class="text-blue-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="student_search" 
                               placeholder="Search student..." 
                               class="h-10 px-3 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                               autocomplete="off">
                        <div id="student_dropdown" class="hidden absolute mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg z-20 max-h-60 overflow-y-auto"></div>
                    </div>
                    <input type="hidden" name="student_id" id="selected_student_id">
                    @error('student_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Student Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Student Name</label>
                    <input type="text" 
                           id="student_name" 
                           readonly 
                           class="h-10 px-3 block w-full rounded border-gray-300 bg-gray-100 text-sm"
                           placeholder="Select student first">
                </div>

                <!-- Guardian Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Guardian Name</label>
                    <input type="text" 
                           id="guardian_name" 
                           readonly 
                           class="h-10 px-3 block w-full rounded border-gray-300 bg-gray-100 text-sm"
                           placeholder="Auto filled">
                </div>
            </div>

            <!-- Date Inputs -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Fees Month <span class="text-blue-500">*</span>
                    </label>
                    <input type="month" 
                           name="fees_month" 
                           id="fees_month"
                           value="{{ old('fees_month') }}" 
                           class="h-10 px-3 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('fees_month')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Date <span class="text-blue-500">*</span>
                    </label>
                    <input type="date" 
                           name="date" 
                           id="fee_date"
                           value="{{ old('date', date('Y-m-d')) }}" 
                           class="h-10 px-3 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- Pending Fees Alert (will be inserted here by JavaScript) -->

        <!-- Fee Details Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Sr.</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium text-gray-700">Particulars</th>
                        <th class="border border-gray-300 px-4 py-2 text-center text-sm font-medium text-gray-700">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">1</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">MONTHLY FEE</td>
                        <td class="border border-gray-300 px-2 py-1">
                            <input type="number" 
                                   name="monthly_fee" 
                                   id="monthly_fee" 
                                   step="0.01" 
                                   value="{{ old('monthly_fee', 0) }}"
                                   class="w-full h-8 px-2 text-center border-0 focus:ring-0 text-sm" 
                                   onchange="calculateTotal()">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">2</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">ADMISSION FEE</td>
                        <td class="border border-gray-300 px-2 py-1">
                            <input type="number" 
                                   name="admission_fee" 
                                   id="admission_fee" 
                                   step="0.01" 
                                   value="{{ old('admission_fee', 0) }}"
                                   class="w-full h-8 px-2 text-center border-0 focus:ring-0 text-sm" 
                                   onchange="calculateTotal()">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">3</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">REGISTRATION FEE</td>
                        <td class="border border-gray-300 px-2 py-1">
                            <input type="number" 
                                   name="registration_fee" 
                                   id="registration_fee" 
                                   step="0.01" 
                                   value="{{ old('registration_fee', 0) }}"
                                   class="w-full h-8 px-2 text-center border-0 focus:ring-0 text-sm" 
                                   onchange="calculateTotal()">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">4</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">HOSTEL FEE</td>
                        <td class="border border-gray-300 px-2 py-1">
                            <input type="number" 
                                   name="hostel_fee" 
                                   id="hostel_fee" 
                                   step="0.01" 
                                   value="{{ old('hostel_fee', 0) }}"
                                   class="w-full h-8 px-2 text-center border-0 focus:ring-0 text-sm" 
                                   onchange="calculateTotal()">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">5</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">PREVIOUS MONTH FEE</td>
                        <td class="border border-gray-300 px-2 py-1">
                            <input type="number" 
                                   name="previous_month_fee" 
                                   id="previous_month_fee" 
                                   step="0.01" 
                                   value="{{ old('previous_month_fee', 0) }}"
                                   class="w-full h-8 px-2 text-center border-0 focus:ring-0 text-sm" 
                                   onchange="calculateTotal()"
                                   readonly>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">6</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">DISCOUNT</td>
                        <td class="border border-gray-300 px-2 py-1">
                            <input type="number" 
                                   name="discount" 
                                   id="discount" 
                                   step="0.01" 
                                   value="{{ old('discount', 0) }}"
                                   class="w-full h-8 px-2 text-center border-0 focus:ring-0 text-sm" 
                                   onchange="calculateTotal()">
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2 text-sm text-center">7</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">OTHER</td>
                        <td class="border border-gray-300 px-2 py-1">
                            <input type="number" 
                                   name="other_fee" 
                                   id="other_fee" 
                                   step="0.01" 
                                   value="{{ old('other_fee', 0) }}"
                                   class="w-full h-8 px-2 text-center border-0 focus:ring-0 text-sm" 
                                   onchange="calculateTotal()">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Totals Section -->
        <div class="bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-700">TOTAL</span>
                    <span id="total_amount" class="font-bold text-lg">0</span>
                    <input type="hidden" name="total_amount" id="total_amount_input">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">DEPOSIT</label>
                    <input type="number" 
                           name="deposit" 
                           id="deposit" 
                           step="0.01" 
                           value="{{ old('deposit', 0) }}"
                           class="h-10 px-3 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-center" 
                           onchange="calculateBalance()">
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-700">DUE-ABLE BALANCE</span>
                    <span id="due_balance" class="font-bold text-lg text-red-600">0</span>
                    <input type="hidden" name="due_balance" id="due_balance_input">
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                <select name="payment_method" class="h-10 px-3 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">Select Method</option>
                    <option value="cash" {{ old('payment_method')=='cash' ? 'selected' : '' }}>Cash</option>
                    <option value="bank" {{ old('payment_method')=='bank' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="online" {{ old('payment_method')=='online' ? 'selected' : '' }}>Online Payment</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Receipt Number</label>
                <input type="text" 
                       name="receipt_number" 
                       value="{{ old('receipt_number') }}" 
                       class="h-10 px-3 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="h-10 px-3 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="pending" {{ old('status','pending')=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ old('status')=='paid' ? 'selected' : '' }}>Paid</option>
                    <option value="partial" {{ old('status')=='partial' ? 'selected' : '' }}>Partial</option>
                </select>
            </div>
        </div>

        <!-- Notes -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
            <textarea name="notes" 
                      rows="2" 
                      class="px-3 py-2 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                      placeholder="Add any additional notes...">{{ old('notes') }}</textarea>
        </div>

        <!-- Actions -->
        <div class="flex justify-center">
            <button type="submit" 
                    class="px-8 py-3 bg-orange-400 text-white rounded-lg hover:bg-orange-500 font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Submit Fees
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Students data from Laravel
    const studentsData = @json($students);
    
    // Student search functionality
    const studentSearch = document.getElementById('student_search');
    const dropdown = document.getElementById('student_dropdown');
    
    studentSearch.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        
        if (query.length < 1) {
            dropdown.classList.add('hidden');
            return;
        }
        
        const filteredStudents = studentsData.filter(student => 
            student.name.toLowerCase().includes(query) || 
            student.id.toString().includes(query)
        );
        
        if (filteredStudents.length > 0) {
            dropdown.innerHTML = filteredStudents.map(student => `
                <div class="px-4 py-2 hover:bg-blue-50 cursor-pointer border-b border-gray-200 student-option" 
                    data-id="${student.id}"
                    data-name="${student.name}"
                    data-father="${student.father_name || ''}">
                    <div class="font-medium text-sm">${student.name} (ID: ${student.id})</div>
                    <div class="text-xs text-gray-500">Guardian: ${student.father_name || 'N/A'}</div>
                </div>
            `).join('');
            dropdown.classList.remove('hidden');
        } else {
            dropdown.innerHTML = '<div class="px-4 py-2 text-gray-500 text-sm">No students found</div>';
            dropdown.classList.remove('hidden');
        }
    });

    // Handle student selection
    dropdown.addEventListener('click', function(e) {
        const option = e.target.closest('.student-option');
        if (option) {
            const student = option.dataset.id;
            const studentName = option.dataset.name;
            const fatherName = option.dataset.father;
            
            // Fill form fields
            studentSearch.value = studentName;
            document.getElementById('selected_student_id').value = student;
            document.getElementById('student_name').value = studentName;
            document.getElementById('guardian_name').value = fatherName;
            
            // Hide dropdown
            dropdown.classList.add('hidden');
            
            // Fetch pending fees
            fetchStudentPendingFees(student);
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!studentSearch.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Fetch student pending fees
    function fetchStudentPendingFees(student) {
        console.log('Fetching pending fees for student ID:', student);
        
        fetch(`/admin/fees/student-pending/${student}`)
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                
                if (data.success) {
                    // Clear previous alert
                    const existingAlert = document.getElementById('pending-alert');
                    if (existingAlert) {
                        existingAlert.remove();
                    }
                    
                    // Show pending fees if exists
                    if (data.pendingFees && data.pendingFees.length > 0) {
                        let totalPending = 0;
                        data.pendingFees.forEach(fee => {
                            totalPending += parseFloat(fee.due_balance);
                        });
                        
                        // Set previous month fee to total pending amount
                        document.getElementById('previous_month_fee').value = totalPending.toFixed(2);
                        
                        // Show alert about pending fees
                        showPendingFeesAlert(data.pendingFees);
                        
                        // Recalculate total
                        calculateTotal();
                    } else {
                        // Clear previous month fee if no pending
                        document.getElementById('previous_month_fee').value = 0;
                        calculateTotal();
                    }
                } else {
                    console.error('API Error:', data.message);
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                alert('Network error fetching student data: ' + error.message);
            });
    }

    // Show pending fees alert
    function showPendingFeesAlert(pendingFees) {
        const alertHtml = `
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" id="pending-alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">This student has pending fees:</p>
                        <ul class="text-xs mt-1">
                            ${pendingFees.map(fee => `<li>• ${fee.fees_month}: Rs. ${parseFloat(fee.due_balance).toFixed(2)}</li>`).join('')}
                        </ul>
                    </div>
                </div>
            </div>
        `;
        
        // Add alert after student search section
        const searchSection = document.querySelector('.bg-gray-50');
        searchSection.insertAdjacentHTML('afterend', alertHtml);
    }

    // Initialize calculations
    calculateTotal();
});

// Calculate total function
function calculateTotal() {
    const monthlyFee = parseFloat(document.getElementById('monthly_fee').value) || 0;
    const admissionFee = parseFloat(document.getElementById('admission_fee').value) || 0;
    const registrationFee = parseFloat(document.getElementById('registration_fee').value) || 0;
    const hostelFee = parseFloat(document.getElementById('hostel_fee').value) || 0;
    const previousMonthFee = parseFloat(document.getElementById('previous_month_fee').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const otherFee = parseFloat(document.getElementById('other_fee').value) || 0;
    
    const total = monthlyFee + admissionFee + registrationFee + hostelFee + previousMonthFee + otherFee - discount;
    
    document.getElementById('total_amount').textContent = total.toFixed(2);
    document.getElementById('total_amount_input').value = total;
    
    calculateBalance();
}

// Calculate balance function
function calculateBalance() {
    const total = parseFloat(document.getElementById('total_amount_input').value) || 0;
    const deposit = parseFloat(document.getElementById('deposit').value) || 0;
    const balance = total - deposit;
    
    document.getElementById('due_balance').textContent = balance.toFixed(2);
    document.getElementById('due_balance_input').value = balance;
    
    // Change color based on balance
    const balanceElement = document.getElementById('due_balance');
    if (balance > 0) {
        balanceElement.className = 'font-bold text-lg text-red-600';
    } else if (balance < 0) {
        balanceElement.className = 'font-bold text-lg text-green-600';
    } else {
        balanceElement.className = 'font-bold text-lg text-gray-800';
    }
}
</script>

@endsection