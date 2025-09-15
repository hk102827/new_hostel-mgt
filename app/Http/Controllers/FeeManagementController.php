<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee_management;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeeManagementController extends Controller
{
    // List fees with filters

public function index(Request $request)
{
    $query = Fee_management::with('student');

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by student
    if ($request->filled('student_id')) {
        $query->where('student_id', $request->student_id);
    }

    // Filter by fees month
    if ($request->filled('fees_month')) {
        $query->where('fees_month', $request->fees_month);
    }

    // Filter by date range
    if ($request->filled('date_from')) {
        $query->whereDate('date', '>=', $request->date_from);
    }
    if ($request->filled('date_to')) {
        $query->whereDate('date', '<=', $request->date_to);
    }

    // Filter by fee type (check which individual fees are greater than 0)
    if ($request->filled('fee_type')) {
        switch ($request->fee_type) {
            case 'monthly_fee':
                $query->where('monthly_fee', '>', 0);
                break;
            case 'admission_fee':
                $query->where('admission_fee', '>', 0);
                break;
            case 'registration_fee':
                $query->where('registration_fee', '>', 0);
                break;
            case 'hostel_fee':
                $query->where('hostel_fee', '>', 0);
                break;
            case 'previous_month_fee':
                $query->where('previous_month_fee', '>', 0);
                break;
            case 'other_fee':
                $query->where('other_fee', '>', 0);
                break;
        }
    }

    $fees = $query->orderByDesc('id')->paginate(15);
    $students = Student::select('id', 'name')->orderBy('name')->get();

    // Get unique fees months for filter dropdown
    $feesMonths = Fee_management::select('fees_month')
        ->distinct()
        ->orderByDesc('fees_month')
        ->pluck('fees_month');

    return view('admin.fees.index', compact('fees', 'students', 'feesMonths'));
}

    // Create form
public function create()
{
    $students = Student::select('id', 'name', 'father_name')
        ->orderBy('name')
        ->get();
        
    return view('admin.fees.create', compact('students'));
}

    // Store fee

public function store(Request $request)
{
    $validated = $request->validate([
        'student_id'         => ['required', 'exists:students,id'],
        'fees_month'         => ['required', 'string'], // 2025-01 format
        'date'               => ['required', 'date'],
        
        // Individual fee fields
        'monthly_fee'        => ['nullable', 'numeric', 'min:0'],
        'admission_fee'      => ['nullable', 'numeric', 'min:0'],
        'registration_fee'   => ['nullable', 'numeric', 'min:0'],
        'hostel_fee'         => ['nullable', 'numeric', 'min:0'],
        'previous_month_fee' => ['nullable', 'numeric', 'min:0'],
        'discount'           => ['nullable', 'numeric', 'min:0'],
        'other_fee'          => ['nullable', 'numeric', 'min:0'],
        
        // Total and payment fields
        'total_amount'       => ['required', 'numeric', 'min:0'],
        'deposit'            => ['nullable', 'numeric', 'min:0'],
        'due_balance'        => ['required', 'numeric'],
        
        // Payment details
        'payment_method'     => ['nullable', 'string', 'max:255'],
        'receipt_number'     => ['nullable', 'string', 'max:255'],
        'status'             => ['required', 'in:pending,paid,partial'],
        'notes'              => ['nullable', 'string'],
    ]);

    // Set default values for nullable numeric fields
    $validated['monthly_fee'] = $validated['monthly_fee'] ?? 0;
    $validated['admission_fee'] = $validated['admission_fee'] ?? 0;
    $validated['registration_fee'] = $validated['registration_fee'] ?? 0;
    $validated['hostel_fee'] = $validated['hostel_fee'] ?? 0;
    $validated['previous_month_fee'] = $validated['previous_month_fee'] ?? 0;
    $validated['discount'] = $validated['discount'] ?? 0;
    $validated['other_fee'] = $validated['other_fee'] ?? 0;
    $validated['deposit'] = $validated['deposit'] ?? 0;

    // Verify calculations (optional but recommended)
    $calculatedTotal = $validated['monthly_fee'] + $validated['admission_fee'] + 
                      $validated['registration_fee'] + $validated['hostel_fee'] + 
                      $validated['previous_month_fee'] + $validated['other_fee'] - 
                      $validated['discount'];
    
    $calculatedBalance = $calculatedTotal - $validated['deposit'];
    
    // Update the validated data with calculated values to ensure accuracy
    $validated['total_amount'] = $calculatedTotal;
    $validated['due_balance'] = $calculatedBalance;
    
    // Auto-determine status based on payment
    if ($validated['deposit'] >= $validated['total_amount']) {
        $validated['status'] = 'paid';
        $validated['due_balance'] = 0;
    } elseif ($validated['deposit'] > 0) {
        $validated['status'] = 'partial';
    } else {
        $validated['status'] = 'pending';
    }

    Fee_management::create($validated);

    return redirect()->route('admin.fees.index')
        ->with('success', 'Fee record created successfully.');
}

    // Edit form
        public function edit($id)
        {
                // Find the fee record
            $fee = Fee_management::with('student')->findOrFail($id);
            
            // Get all students for the dropdown
            $students = Student::select('id', 'name', 'father_name')->get();
            
            return view('admin.fees.edit', compact('fee', 'students'));
        }

    // Update
public function update(Request $request, $id)
{
    $fee = Fee_management::findOrFail($id);
    
    $validated = $request->validate([
        'student_id'         => ['required', 'exists:students,id'],
        'fees_month'         => ['required', 'string'], // 2025-01 format
        'date'               => ['required', 'date'],
        
        // Individual fee fields
        'monthly_fee'        => ['nullable', 'numeric', 'min:0'],
        'admission_fee'      => ['nullable', 'numeric', 'min:0'],
        'registration_fee'   => ['nullable', 'numeric', 'min:0'],
        'hostel_fee'         => ['nullable', 'numeric', 'min:0'],
        'previous_month_fee' => ['nullable', 'numeric', 'min:0'],
        'discount'           => ['nullable', 'numeric', 'min:0'],
        'other_fee'          => ['nullable', 'numeric', 'min:0'],
        
        // Total and payment fields
        'total_amount'       => ['required', 'numeric', 'min:0'],
        'deposit'            => ['nullable', 'numeric', 'min:0'],
        'due_balance'        => ['required', 'numeric'],
        
        // Payment details
        'payment_method'     => ['nullable', 'string', 'max:255'],
        'receipt_number'     => ['nullable', 'string', 'max:255'],
        'status'             => ['required', 'in:pending,paid,partial'],
        'notes'              => ['nullable', 'string'],
    ]);

    // Set default values for nullable numeric fields
    $validated['monthly_fee'] = $validated['monthly_fee'] ?? 0;
    $validated['admission_fee'] = $validated['admission_fee'] ?? 0;
    $validated['registration_fee'] = $validated['registration_fee'] ?? 0;
    $validated['hostel_fee'] = $validated['hostel_fee'] ?? 0;
    $validated['previous_month_fee'] = $validated['previous_month_fee'] ?? 0;
    $validated['discount'] = $validated['discount'] ?? 0;
    $validated['other_fee'] = $validated['other_fee'] ?? 0;
    $validated['deposit'] = $validated['deposit'] ?? 0;

    // Verify calculations (optional but recommended)
    $calculatedTotal = $validated['monthly_fee'] + $validated['admission_fee'] + 
                      $validated['registration_fee'] + $validated['hostel_fee'] + 
                      $validated['previous_month_fee'] + $validated['other_fee'] - 
                      $validated['discount'];
    
    $calculatedBalance = $calculatedTotal - $validated['deposit'];
    
    // Update the validated data with calculated values to ensure accuracy
    $validated['total_amount'] = $calculatedTotal;
    $validated['due_balance'] = $calculatedBalance;
    
    // Auto-determine status based on payment
    if ($validated['deposit'] >= $validated['total_amount']) {
        $validated['status'] = 'paid';
        $validated['due_balance'] = 0;
    } elseif ($validated['deposit'] > 0) {
        $validated['status'] = 'partial';
    } else {
        $validated['status'] = 'pending';
    }

    $fee->update($validated);

    return redirect()->route('admin.fees.index')
        ->with('success', 'Fee record updated successfully.');
}
    // Delete
    public function destroy($id)
    {
        $fee = Fee_management::findOrFail($id);
        $fee->delete();
        return redirect()->route('admin.fees.index')->with('success', 'Fee deleted successfully.');
    }

public function getStudentPendingFees($student)
{
    try {
        // Log the request
        Log::info("Fetching pending fees for student ID: " . $student);
        
        // Get student details
        $student = Student::findOrFail($student);
        Log::info("Student found: " . $student->name);
        
        // Get pending fees for this student
      $pendingFees = DB::table('fee_managements')
    ->where('student_id', $student->id)
    ->whereIn('status', ['pending', 'partial']) // sirf pending/partial hi
    ->orderBy('fees_month', 'asc')
    ->get([
        'id',
        'monthly_fee',
        'admission_fee',
        'registration_fee',
        'hostel_fee',
        'previous_month_fee',
        'discount',
        'other_fee',
        'total_amount',
        'deposit',
        'due_balance',
        'fees_month',
        'date',
        'status',
        'payment_method',
        'receipt_number',
        'notes',
    ]);

        
        Log::info("Pending fees count: " . $pendingFees->count());
        
        return response()->json([
            'success' => true,
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'father_name' => $student->father_name,
            ],
            'pendingFees' => $pendingFees
        ]);
        
    } catch (\Exception $e) {
        // Log the actual error
        Log::error('Error fetching student pending fees: ' . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return response()->json([
            'success' => false,
            'message' => 'Error fetching student data: ' . $e->getMessage(),
            'debug' => config('app.debug') ? $e->getTraceAsString() : null
        ], 500);
    }
}


    public function show($id)
    {
        // Find the fee record with student relationship
        $fee = Fee_management::with('student')->findOrFail($id);
        
        return view('admin.fees.show', compact('fee'));
    }

}
