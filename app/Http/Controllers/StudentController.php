<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Room;
use App\Models\Room_assignment;


class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['roomAssignment.room', 'japaneseAcademy', 'messManagement'])->latest();

        if ($request->filled('academy')) {
            if ($request->academy === 'enrolled') {
                $query->whereHas('japaneseAcademy');
            } elseif ($request->academy === 'not_enrolled') {
                $query->whereDoesntHave('japaneseAcademy');
            }
        }

        $students = $query->paginate(10)->withQueryString();
        return view('admin.students.index', compact('students'));
    }
    public function create()
    {
         $available_rooms = Room::whereColumn('occupied', '<', 'capacity')->get();
        // dd($available_rooms);
        return view('admin.students.create', compact('available_rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'cnic' => 'required|string|max:15',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'emergency_contact' => 'required|string|max:15',
            'room_id' => 'nullable|exists:rooms,id',
            'admission_date' => 'nullable|date',
        ]);

        $student = Student::create($validated);
        if ($request->room_id) {
            Room_assignment::create([
                'student_id'    => $student->id,
                'room_id'       => $request->room_id,
                'assigned_date' => now(),
                'status'        => 'active',
         ]);
}
        return redirect()->route('admin.students.index')->with('success', 'Student added successfully.');
    }


    public function edit(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $available_rooms = Room::whereColumn('occupied', '<', 'capacity')->get();
         // agar student ka active room assignment hai to uska id nikalo
        $assigned_room_id = $student->roomAssignment ? $student->roomAssignment->room_id : null;
        return view('admin.students.edit', compact('student', 'available_rooms', 'assigned_room_id'));
    }

    public function update(Request $request, $id)
        {
            $student = Student::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'cnic' => 'required|string|max:15',
                'phone' => 'required|string|max:15',
                'email' => 'required|email',
                'address' => 'required|string',
                'emergency_contact' => 'required|string',
                'admission_date' => 'required|date',
                'room_id' => 'nullable|exists:rooms,id',
            ]);

            // Student details update
            $student->update($validated);

            // Room assignment update
            if ($request->room_id) {
                // purani active assignment ko deactivate kar do
                if ($student->roomAssignment) {
                    $student->roomAssignment->update(['status' => 'completed']);
                }

                // naya assignment create karo
                Room_assignment::create([
                    'student_id' => $student->id,
                    'room_id' => $request->room_id,
                    'assigned_date' => now(),
                    'status' => 'active',
                ]);
            }

            return redirect()->route('admin.students.index')->with('success', 'Student updated successfully');
        }


        // app/Http/Controllers/RoomAssignmentController.php
        public function destroy($id)
        {
            $assignment = Student::findOrFail($id);
            $assignment->delete();

            return redirect()->back()->with('success', 'Room assignment deleted successfully.');
        }




        




}
