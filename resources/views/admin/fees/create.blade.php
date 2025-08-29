@extends('layouts.admin')

@section('title', 'Add Fee')
@section('page-title', 'Create Fee')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-6">Create Fee</h2>

    <form action="{{ route('admin.fees.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Student -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
            <select name="student_id" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="">Select student</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" {{ old('student_id')==$s->id ? 'selected' : '' }}>{{ $s->name }} (ID: {{ $s->id }})</option>
                @endforeach
            </select>
            @error('student_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

{{-- Fee Type --}}
<div class="relative w-full">
    <label for="fee_type" class="block text-sm font-medium text-gray-700 mb-1">Fee Type</label>
    
    <div class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm cursor-pointer flex flex-wrap gap-2 items-center"
         onclick="toggleFeeDropdown()">
        <div id="selected-fees" class="flex gap-2 flex-wrap">
            <span class="text-gray-400">Select Fee Type...</span>
        </div>
        <svg class="inline-block h-5 w-5 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </div>

    {{-- Hidden input (array) --}}
    <input type="hidden" name="fee_type" id="fee_type_input">

    <div id="fee-dropdown" class="hidden absolute mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg z-10">
        <div class="flex items-center px-4 py-2 hover:bg-gray-100">
            <input type="checkbox" id="fee-hostel" value="hostel_rent" class="mr-2" onchange="updateFeeSelected()">
            <label for="fee-hostel">Hostel Rent</label>
        </div>
        <div class="flex items-center px-4 py-2 hover:bg-gray-100">
            <input type="checkbox" id="fee-mess" value="mess_fee" class="mr-2" onchange="updateFeeSelected()">
            <label for="fee-mess">Mess Fee</label>
        </div>
        <div class="flex items-center px-4 py-2 hover:bg-gray-100">
            <input type="checkbox" id="fee-japanese" value="japanese_course" class="mr-2" onchange="updateFeeSelected()">
            <label for="fee-japanese">Japanese Course</label>
        </div>
        <div class="flex items-center px-4 py-2 hover:bg-gray-100">
            <input type="checkbox" id="fee-security" value="security_deposit" class="mr-2" onchange="updateFeeSelected()">
            <label for="fee-security">Security Deposit</label>
        </div>
        <div class="flex items-center px-4 py-2 hover:bg-gray-100">
            <input type="checkbox" id="fee-other" value="other" class="mr-2" onchange="updateFeeSelected()">
            <label for="fee-other">Other</label>
        </div>
    </div>

    @error('fee_type')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>




        <!-- Amount -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('amount')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Due Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('due_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Paid Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Paid Date (optional)</label>
            <input type="date" name="paid_date" value="{{ old('paid_date') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('paid_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                <option value="pending" {{ old('status','pending')=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ old('status')=='paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ old('status')=='overdue' ? 'selected' : '' }}>Overdue</option>
                <option value="partial" {{ old('status')=='partial' ? 'selected' : '' }}>Partial</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Paid Amount -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Paid Amount (optional)</label>
            <input type="number" step="0.01" name="paid_amount" value="{{ old('paid_amount') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
            @error('paid_amount')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Payment Method and Receipt -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method (optional)</label>
                <input type="text" name="payment_method" value="{{ old('payment_method') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                @error('payment_method')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Receipt Number (optional)</label>
                <input type="text" name="receipt_number" value="{{ old('receipt_number') }}" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                @error('receipt_number')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Notes -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
            <textarea name="notes" rows="3" class="px-3 py-2 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">{{ old('notes') }}</textarea>
            @error('notes')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.fees.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
        </div>
    </form>
</div>


<script>
function toggleFeeDropdown() {
    document.getElementById('fee-dropdown').classList.toggle('hidden');
}

function updateFeeSelected() {
    const checkboxes = document.querySelectorAll('#fee-dropdown input[type="checkbox"]');
    const selectedContainer = document.getElementById('selected-fees');
    const hiddenInput = document.getElementById('fee_type_input');

    selectedContainer.innerHTML = '';
    let selectedValues = [];

    checkboxes.forEach(cb => {
        if (cb.checked) {
            selectedValues.push(cb.value);

            const tag = document.createElement('span');
            tag.className = 'bg-indigo-100 text-indigo-700 px-2 py-1 rounded flex items-center gap-1 cursor-pointer';
            tag.innerHTML = cb.nextElementSibling.innerText + 
                ` <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" onclick="removeFee('${cb.id}')"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>`;
            
            selectedContainer.appendChild(tag);
        }
    });

    if (selectedValues.length === 0) {
        selectedContainer.innerHTML = '<span class="text-gray-400">Select Fee Type...</span>';
    }

    hiddenInput.value = selectedValues.join(',');
}

function removeFee(id) {
    document.getElementById(id).checked = false;
    updateFeeSelected();
}

// Close dropdown on outside click
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('fee-dropdown');
    const trigger = event.target.closest('[onclick="toggleFeeDropdown()"]');
    if (!dropdown.contains(event.target) && !trigger) {
        dropdown.classList.add('hidden');
    }
});
</script>

@endsection