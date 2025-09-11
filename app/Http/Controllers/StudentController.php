<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Room;
use App\Models\Room_assignment;
use App\Models\StudentQualification;
use App\Models\StudentExperience;
use App\Models\StudentReference;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class StudentController extends Controller
{
public function index(Request $request)
{
    $query = Student::with(['roomAssignment.room', 'japaneseAcademy', 'messManagement'])->latest();

    // Search by Student Name only
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
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
        // Validation rules
        $validator = Validator::make($request->all(), [
            // Personal Information
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'cnic' => 'required|string|unique:students,cnic|regex:/^\d{5}-\d{7}-\d{1}$/',
            'date_of_birth' => 'required|date|before:today',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:students,email',
            'nationality' => 'required|string|max:100',
            'religion' => 'nullable|string|max:100',
            'sect' => 'nullable|string|max:100',
            'postal_address' => 'required|string',
            'address' => 'required|string',
            'emergency_contact' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Station/Department
            'station' => 'nullable|string|in:Islamabad,Lahore,Karachi',
            'department' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'job_type' => 'required|in:permanent,contract,temporary',
            
            // Admission
            'admission_date' => 'required|date',
            'room_id' => 'nullable|exists:rooms,id',
            
            // Qualifications (arrays)
            'qualifications' => 'nullable|array',
            'qualifications.*.degree_type' => 'required_with:qualifications|in:SSC,HSSC,Bachelor,Masters,MS/M.Phil,Ph.D',
            'qualifications.*.duration_years' => 'required_with:qualifications|numeric|min:0.5|max:10',
            'qualifications.*.specialization' => 'nullable|string|max:255',
            'qualifications.*.passing_year' => 'required_with:qualifications|integer|min:1950|max:2030',
            'qualifications.*.cgpa_grade' => 'required_with:qualifications|string|max:10',
            'qualifications.*.institute_board_university' => 'required_with:qualifications|string|max:255',
            'qualifications.*.country' => 'required_with:qualifications|string|max:100',
            
            // Experiences (arrays)
            'experiences' => 'nullable|array',
            'experiences.*.institution_organization' => 'required_with:experiences|string|max:255',
            'experiences.*.position_job_title' => 'required_with:experiences|string|max:255',
            'experiences.*.from_date' => 'required_with:experiences|date',
            'experiences.*.to_date' => 'nullable|date|after_or_equal:experiences.*.from_date',
            'experiences.*.total_period_months' => 'nullable|integer|min:1',
            
            // References (arrays)
            'references' => 'nullable|array',
            'references.*.name' => 'required_with:references|string|max:255',
            'references.*.designation' => 'required_with:references|string|max:255',
            'references.*.contact_no' => 'required_with:references|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Create main student record
            $student = Student::create([
                'name' => $request->name,
                'father_name' => $request->father_name,
                'gender' => $request->gender,
                'cnic' => $request->cnic,
                'date_of_birth' => $request->date_of_birth,
                'marital_status' => $request->marital_status,
                'phone' => $request->phone,
                'email' => $request->email,
                'nationality' => $request->nationality,
                'religion' => $request->religion,
                'sect' => $request->sect,
                'postal_address' => $request->postal_address,
                'address' => $request->address,
                'emergency_contact' => $request->emergency_contact,
                'station' => $request->station,
                'department' => $request->department,
                'specialization' => $request->specialization,
                'job_type' => $request->job_type,
                'admission_date' => $request->admission_date,
                'room_id' => $request->room_id,
                'status' => 'active'
            ]);

         if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('students', 'public');
                $student->photo = $path;
                $student->save(); // 👈 save karein taake photo field DB me store ho
            }



            // Store qualifications
            if ($request->has('qualifications') && is_array($request->qualifications)) {
                foreach ($request->qualifications as $qualification) {
                    if (!empty($qualification['degree_type'])) {
                        StudentQualification::create([
                            'student_id' => $student->id,
                            'degree_type' => $qualification['degree_type'],
                            'duration_years' => $qualification['duration_years'],
                            'specialization' => $qualification['specialization'] ?? null,
                            'passing_year' => $qualification['passing_year'],
                            'cgpa_grade' => $qualification['cgpa_grade'],
                            'institute_board_university' => $qualification['institute_board_university'],
                            'country' => $qualification['country'] ?? 'Pakistan'
                        ]);
                    }
                }
            }

            // Store experiences
            if ($request->has('experiences') && is_array($request->experiences)) {
                foreach ($request->experiences as $experience) {
                    if (!empty($experience['institution_organization'])) {
                        StudentExperience::create([
                            'student_id' => $student->id,
                            'institution_organization' => $experience['institution_organization'],
                            'position_job_title' => $experience['position_job_title'],
                            'from_date' => $experience['from_date'],
                            'to_date' => $experience['to_date'] ?? null,
                            'total_period_months' => $experience['total_period_months'] ?? 0
                        ]);
                    }
                }
            }

            // Store references
            if ($request->has('references') && is_array($request->references)) {
                foreach ($request->references as $reference) {
                    if (!empty($reference['name'])) {
                        StudentReference::create([
                            'student_id' => $student->id,
                            'name' => $reference['name'],
                            'designation' => $reference['designation'],
                            'contact_no' => $reference['contact_no']
                        ]);
                    }
                }
            }

            // Update room occupancy if room is assigned
            if ($request->room_id) {
                $room = Room::find($request->room_id);
                if ($room && $room->occupied < $room->capacity) {
                    $room->increment('occupied');
                }
            }

            DB::commit();
            
            return redirect()
                ->route('admin.students.index')
                ->with('success', 'Student added successfully with all details!');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again. Error: ' . $e->getMessage());
        }
    }
    
    public function edit(Request $request, $id)
    {
        $student = Student::with(['qualifications', 'experiences', 'references', 'roomAssignment.room'])->findOrFail($id);
        $available_rooms = Room::whereColumn('occupied', '<', 'capacity')->orWhere('id', $student->room_id)->get();
        return view('admin.students.edit', compact('student', 'available_rooms'));
    }

   public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    // ✅ Basic Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'father_name' => 'required|string|max:255',
        'gender' => 'required|string',
        'cnic' => 'required|string',
        'date_of_birth' => 'required|date',
        'marital_status' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
        'nationality' => 'required|string',
        'admission_date' => 'required|date',
        'room_id' => 'nullable|exists:rooms,id',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // ✅ Update basic student data (except photo)
    $student->fill($request->except('photo'));

    // ✅ Photo update handling
    if ($request->hasFile('photo')) {
        // Purani photo delete
        if ($student->photo && \Storage::exists('public/'.$student->photo)) {
            \Storage::delete('public/'.$student->photo);
        }

        // Nayi photo save
        $path = $request->file('photo')->store('students', 'public');
        $student->photo = $path;
    }

    $student->save();

    // ✅ Qualifications update
    if ($request->has('qualifications')) {
        $student->qualifications()->delete(); // Purani delete
        foreach ($request->qualifications as $qualification) {
            $student->qualifications()->create($qualification);
        }
    }

    // ✅ Experiences update
    if ($request->has('experiences')) {
        $student->experiences()->delete();
        foreach ($request->experiences as $experience) {
            $student->experiences()->create($experience);
        }
    }

    // ✅ References update
    if ($request->has('references')) {
        $student->references()->delete();
        foreach ($request->references as $reference) {
            $student->references()->create($reference);
        }
    }

    return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
}


    public function show($id)
    {
        $student = Student::with(['roomAssignment.room', 'japaneseAcademy', 'messManagement'])->findOrFail($id);
        
        return view('admin.students.show', compact('student'));
    }

    public function showForm($id)
    {
        $student = Student::with(['roomAssignment.room', 'japaneseAcademy', 'messManagement'])->findOrFail($id);

        return view('admin.students.form', compact('student'));
    }



        // app/Http/Controllers/RoomAssignmentController.php
        public function destroy($id)
        {
            $assignment = Student::findOrFail($id);
            $assignment->delete();

            return redirect()->back()->with('success', 'Room assignment deleted successfully.');
        }




        




}
