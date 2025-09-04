<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee_management;
use App\Models\Student;

class FeeManagementController extends Controller
{
    // List fees with filters
    public function index(Request $request)
    {
        $query = Fee_management::with('student');

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->fee_type) {
            $query->where('fee_type', $request->fee_type);
        }
        if ($request->student_id) {
            $query->where('student_id', $request->student_id);
        }
        $query = Fee_management::query();

        if ($request->has('status')) {
            $statuses = (array) $request->status; // multiple values allowed
            $query->whereIn('status', $statuses);
        }

        $fees = $query->get();


        $fees = $query->orderByDesc('id')->get();
        $students = Student::select('id','name')->orderBy('name')->get();

        return view('admin.fees.index', compact('fees','students'));
    }

    // Create form
    public function create()
    {
        $students = Student::select('id','name')->orderBy('name')->get();
        return view('admin.fees.create', compact('students'));
    }

    // Store fee
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'      => ['required', 'exists:students,id'],
            'fee_type'        => ['required', 'string'],
            'amount'          => ['required', 'numeric', 'min:0'],
            'due_date'        => ['required', 'date'],
            'paid_date'       => ['nullable', 'date', 'after_or_equal:due_date'],
            'status'          => ['required', 'in:pending,paid,overdue,partial'],
            'paid_amount'     => ['nullable', 'numeric', 'min:0'],
            'payment_method'  => ['nullable', 'string', 'max:255'],
            'receipt_number'  => ['nullable', 'string', 'max:255'],
            'notes'           => ['nullable', 'string'],
        ]);

        // Default paid_amount to 0 if null
        if (!isset($validated['paid_amount'])) {
            $validated['paid_amount'] = 0;
        }
        
        // Convert to array
            $feeTypes = explode(',', $validated['fee_type']);

            // Store as JSON (better for multiple values)
            $validated['fee_type'] = json_encode($feeTypes);

        Fee_management::create($validated);

        return redirect()->route('admin.fees.index')->with('success', 'Fee created successfully.');
    }

    // Edit form
        public function edit($id)
        {
            $fee = Fee_management::findOrFail($id);
            if (is_string($fee->fee_type)) {
                $fee->fee_type = json_decode($fee->fee_type, true) ?: [$fee->fee_type];
            } elseif (!is_array($fee->fee_type)) {
                $fee->fee_type = [];
            }
            
            $students = Student::select('id','name')->orderBy('name')->get();
            return view('admin.fees.edit', compact('fee','students'));
        }

    // Update
    public function update(Request $request, $id)
    {
        $fee = Fee_management::findOrFail($id);

        $validated = $request->validate([
            'student_id'      => ['required', 'exists:students,id'],
            'fee_type'        => ['required', 'string'],
            'amount'          => ['required', 'numeric', 'min:0'],
            'due_date'        => ['required', 'date'],
            'paid_date'       => ['nullable', 'date', 'after_or_equal:due_date'],
            'status'          => ['required', 'in:pending,paid,overdue,partial'],
            'paid_amount'     => ['nullable', 'numeric', 'min:0'],
            'payment_method'  => ['nullable', 'string', 'max:255'],
            'receipt_number'  => ['nullable', 'string', 'max:255'],
            'notes'           => ['nullable', 'string'],
        ]);

        if (!isset($validated['paid_amount'])) {
            $validated['paid_amount'] = 0;
        }

        // Convert to array
        $feeTypes = explode(',', $validated['fee_type']);

        // Store as JSON (better for multiple values)
        $validated['fee_type'] = json_encode($feeTypes);

        $fee->update($validated);

        return redirect()->route('admin.fees.index')->with('success', 'Fee updated successfully.');
    }

    // Delete
    public function destroy($id)
    {
        $fee = Fee_management::findOrFail($id);
        $fee->delete();
        return redirect()->route('admin.fees.index')->with('success', 'Fee deleted successfully.');
    }
}
