<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Student;
use App\Models\StudentQualification;
use App\Models\StudentExperience;
use App\Models\StudentReference;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->take(8)->get();
        // dd($rooms);
        return view('frontend.index', compact('rooms'));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function accomodation()
    {
        return view('frontend.accomodation');
    }
    public function blogsingle()
    {
        return view('frontend.blog_single');
    }
    public function blog()
    {
        return view('frontend.blog');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function elements()
    {
        return view('frontend.elements');
    }
    public function gallery()
    {
        return view('frontend.gallery');
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
            
            return redirect()->back()->with('success', '🎉 Application Submitted! Your application has been successfully saved.');

                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again. Error: ' . $e->getMessage());
        }
    }
}
