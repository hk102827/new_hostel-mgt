<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JapaneseAcademyStudent;
use App\Models\Student;

class JapaneseAcademyController extends Controller
{
    // List with filters
public function index(Request $request)
{
    $query = JapaneseAcademyStudent::with('messManagement'); // relation include
    // dd($query->get());

    if ($request->type) {
        $query->where('student_type', $request->type); // online / physical
    }

    if ($request->hostel !== null && $request->hostel !== '') {
        $query->where('hostel', (bool)$request->hostel); // 1 = hostel, 0 = not
    }

    $students = $query->select([
        'id',
        'name',
        'father_name',
        'phone',
        'student_type as type',
        'hostel as is_in_hostel',
    ])->get();

    return view('admin.accademy.index', compact('students'));
}


    // Show create form
    public function create()
    {
        echo "here";
        $students = Student::select('id', 'name')->orderBy('name')->get();
        return view('admin.accademy.create', compact('students'));
    }

    // Store new record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'     => ['nullable', 'exists:students,id'],
            'name'           => ['required', 'string', 'max:255'],
            'father_name'    => ['nullable', 'string', 'max:255'],
            'cnic'           => ['required', 'string', 'max:255', 'unique:japanese_academy_students,cnic'],
            'phone'          => ['nullable', 'string', 'max:255'],
            'student_type'   => ['required', 'in:online,physical'],
            'hostel'         => ['required', 'in:0,1'],
            'admission_date' => ['nullable', 'date'],
            'course'         => ['nullable', 'string', 'max:255'],
            'status'         => ['required', 'in:active,inactive,completed'],
        ]);

        $record = new JapaneseAcademyStudent();
        $record->student_id     = $validated['student_id'] ?? null;
        $record->name           = $validated['name'];
        $record->father_name    = $validated['father_name'] ?? null;
        $record->cnic           = $validated['cnic'];
        $record->phone          = $validated['phone'] ?? null;
        $record->student_type   = $validated['student_type'];
        $record->hostel         = (bool)($validated['hostel'] ?? 0);
        $record->admission_date = $validated['admission_date'] ?? null;
        $record->course         = $validated['course'] ?? null;
        $record->status         = $validated['status'];
        $record->save();

        return redirect()->route('admin.academy.index')
            ->with('success', 'Academy student created successfully.');
    }

    // Show single record
    public function show($id)
    {
        $student = JapaneseAcademyStudent::findOrFail($id);
        return view('admin.accademy.show', compact('student'));
    }

    // Edit form
    public function edit($id)
    {
        $student = JapaneseAcademyStudent::findOrFail($id);
        $students = Student::select('id', 'name')->orderBy('name')->get();
        return view('admin.accademy.edit', compact('student', 'students'));
    }

    // Update record
    public function update(Request $request, $id)
    {
        $student = JapaneseAcademyStudent::findOrFail($id);

        $validated = $request->validate([
            'student_id'     => ['nullable', 'exists:students,id'],
            'name'           => ['required', 'string', 'max:255'],
            'father_name'    => ['nullable', 'string', 'max:255'],
            'cnic'           => ['required', 'string', 'max:255', 'unique:japanese_academy_students,cnic,' . $student->id],
            'phone'          => ['nullable', 'string', 'max:255'],
            'student_type'   => ['required', 'in:online,physical'],
            'hostel'         => ['required', 'in:0,1'],
            'admission_date' => ['nullable', 'date'],
            'course'         => ['nullable', 'string', 'max:255'],
            'status'         => ['required', 'in:active,inactive,completed'],
        ]);

        $student->student_id     = $validated['student_id'] ?? null;
        $student->name           = $validated['name'];
        $student->father_name    = $validated['father_name'] ?? null;
        $student->cnic           = $validated['cnic'];
        $student->phone          = $validated['phone'] ?? null;
        $student->student_type   = $validated['student_type'];
        $student->hostel         = (bool)($validated['hostel'] ?? 0);
        $student->admission_date = $validated['admission_date'] ?? null;
        $student->course         = $validated['course'] ?? null;
        $student->status         = $validated['status'];
        $student->save();

        return redirect()->route('admin.academy.index')
            ->with('success', 'Academy student updated successfully.');
    }

    // Delete record
    public function destroy($id)
    {
        $student = JapaneseAcademyStudent::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.academy.index')
            ->with('success', 'Academy student deleted successfully.');
    }
}
