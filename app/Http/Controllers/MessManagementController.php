<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mess_management;
use App\Models\Student;

class MessManagementController extends Controller
{
    // List all mess subscriptions
    public function index(Request $request)
    {
        $query = Mess_management::with('student');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->plan_type) {
            $query->where('plan_type', $request->plan_type);
        }

        $records = $query->orderByDesc('id')->get();

        return view('admin.mess.index', compact('records'));
    }

    // Show create form
    public function create()
    {
        $students = Student::select('id','name')->orderBy('name')->get();
        return view('admin.mess.create', compact('students'));
    }

    // Store new mess record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'plan_type'  => ['required', 'in:full_board,breakfast_lunch,lunch_dinner,lunch_only'],
            'monthly_fee'=> ['required', 'numeric','min:0'],
            'start_date' => ['required', 'date'],
            'end_date'   => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'     => ['required', 'in:active,inactive,suspended'],
            'dietary_restrictions' => ['nullable', 'string'],
        ]);

        Mess_management::create($validated);

        return redirect()->route('admin.mess.index')->with('success','Mess record created successfully.');
    }

    // Edit form
    public function edit($id)
    {
        $record = Mess_management::findOrFail($id);
        $students = Student::select('id','name')->orderBy('name')->get();
        return view('admin.mess.edit', compact('record','students'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $record = Mess_management::findOrFail($id);

        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'plan_type'  => ['required', 'in:full_board,breakfast_lunch,lunch_dinner,lunch_only'],
            'monthly_fee'=> ['required', 'numeric','min:0'],
            'start_date' => ['required', 'date'],
            'end_date'   => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'     => ['required', 'in:active,inactive,suspended'],
            'dietary_restrictions' => ['nullable', 'string'],
        ]);

        $record->update($validated);

        return redirect()->route('admin.mess.index')
            ->with('success','Mess record updated successfully.');
    }

    // Delete
    public function destroy($id)
    {
        $record = Mess_management::findOrFail($id);
        $record->delete();

        return redirect()->route('admin.mess.index')
            ->with('success','Mess record deleted successfully.');
    }
}
