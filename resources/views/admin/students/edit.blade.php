@extends('layouts.admin')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form method="POST" action="{{ route('admin.students.update', $student->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Personal Information --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">1. Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', $student->name) }}"
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name *</label>
                        <input type="text" name="father_name" value="{{ old('father_name', $student->father_name) }}"
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                        <select name="gender" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md" required>
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">CNIC *</label>
                        <input type="text" name="cnic" value="{{ old('cnic', $student->cnic) }}" placeholder="12345-6789012-3"
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Marital Status *</label>
                        <select name="marital_status" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>
                            <option value="">Select Status</option>
                            <option value="single" {{ old('marital_status', $student->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="married" {{ old('marital_status', $student->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                            <option value="divorced" {{ old('marital_status', $student->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                            
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $student->email) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nationality *</label>
                        <input type="text" name="nationality" value="{{ old('nationality', $student->nationality) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
                        <input type="text" name="religion" value="{{ old('religion', $student->religion) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sect</label>
                        <input type="text" name="sect" value="{{ old('sect', $student->sect) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact *</label>
                        <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $student->emergency_contact) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Postal Address *</label>
                        <textarea name="postal_address" rows="3" 
                                  class="px-3 py-2 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>{{ old('postal_address', $student->postal_address) }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Address *</label>
                        <textarea name="address" rows="3" 
                                  class="px-3 py-2 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base" required>{{ old('address', $student->address) }}</textarea>
                    </div>
                    

                    {{-- baaki CNIC, DOB, Marital status, phone, email, etc bhi isi tarah --}}
                </div>
            </div>

                    {{-- Station/Department Information --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Department & Station</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Station</label>
                        <select name="station" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value="">Select Station</option>
                            <option value="Islamabad" {{ old('station', $student->station) == 'Islamabad' ? 'selected' : '' }}>Islamabad</option>
                            <option value="Lahore" {{ old('station', $student->station) == 'Lahore' ? 'selected' : '' }}>Lahore</option>
                            <option value="Karachi" {{ old('station', $student->station) == 'Karachi' ? 'selected' : '' }}>Karachi</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <input type="text" name="department" value="{{ old('department', $student->department) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                        <input type="text" name="specialization" value="{{ old('specialization', $student->specialization) }}" 
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                        <select name="job_type" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 text-base">
                            <option value="permanent" {{ old('job_type', $student->job_type) == 'permanent' ? 'selected' : '' }}>Permanent</option>
                            <option value="contract" {{ old('job_type', $student->job_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="temporary" {{ old('job_type', $student->job_type) == 'temporary' ? 'selected' : '' }}>Temporary</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Qualifications Section --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">2. Qualifications</h3>
                <div id="qualifications-container">
                    <div class="qualification-row grid grid-cols-1 md:grid-cols-7 gap-4 mb-4 p-4 border rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Degree</label>
                            <select name="qualifications[0][degree_type] " class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                                <option value="SSC" {{ $student->qualifications[0]->degree_type == 'SSC' ? 'selected' : '' }}>SSC</option>
                               <option value="HSSC" {{ $student->qualifications[0]->degree_type == 'HSSC' ? 'selected' : '' }}>HSSC</option>
                                <option value="Bachelor" {{ $student->qualifications[0]->degree_type == 'Bachelor' ? 'selected' : '' }}>Bachelor</option>
                                <option value="Masters" {{ $student->qualifications[0]->degree_type == 'Masters' ? 'selected' : '' }}>Masters</option>
                                <option value="MS/M.Phil" {{ $student->qualifications[0]->degree_type == 'MS/M.Phil' ? 'selected' : '' }}>MS/M.Phil</option>
                                <option value="Ph.D" {{ $student->qualifications[0]->degree_type == 'Ph.D' ? 'selected' : '' }}>Ph.D</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Duration (Years)</label>
                            <input type="number" step="0.1" name="qualifications[0][duration_years]" value="{{ old('qualifications[0][duration_years]', $student->qualifications[0]->duration_years) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                            <input type="text" name="qualifications[0][specialization]" value="{{ old('qualifications[0][specialization]', $student->qualifications[0]->specialization) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
                            <input type="number" min="1950" max="2030" name="qualifications[0][passing_year]" value="{{ old('qualifications[0][passing_year]', $student->qualifications[0]->passing_year) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">CGPA/Grade</label>
                            <input type="text" name="qualifications[0][cgpa_grade]" value="{{ old('qualifications[0][cgpa_grade]', $student->qualifications[0]->cgpa_grade) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Institute/Board/University</label>
                            <input type="text" name="qualifications[0][institute_board_university]" value="{{ old('qualifications[0][institute_board_university]', $student->qualifications[0]->institute_board_university) }}"" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <input type="text" name="qualifications[0][country]" value="{{ old('qualifications[0][country]', $student->qualifications[0]->country) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addQualification()" class="text-blue-600 hover:text-blue-800 text-sm">+ Add Another Qualification</button>
            </div>

            {{-- Experience Section --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">3. Experience</h3>
                <div id="experience-container">
                    <div class="experience-row grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 p-4 border rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Institution/Organization</label>
                            <input type="text" name="experiences[0][institution_organization]" value="{{ old('experiences[0][institution_organization]', $student->experiences[0]->institution_organization)}}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Position/Job Title</label>
                            <input type="text" name="experiences[0][position_job_title]" value="{{ old('experiences[0][position_job_title]', $student->experiences[0]->position_job_title) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                            <input type="date" name="experiences[0][from_date]" value="{{ old('experiences[0][from_date]', $student->experiences[0]->from_date) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                            <input type="date" name="experiences[0][to_date]" value="{{ old('experiences[0][to_date]', $student->experiences[0]->to_date) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Period (Months)</label>
                            <input type="number" name="experiences[0][total_period_months]" value="{{ old('experiences[0][total_period_months]', $student->experiences[0]->total_period_months) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addExperience()" class="text-blue-600 hover:text-blue-800 text-sm">+ Add Another Experience</button>
            </div>

            {{-- References Section --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">4. References</h3>
                <div id="references-container">
                    <div class="reference-row grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 p-4 border rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="references[0][name]" value="{{ old('references[0][name]' , $student->references[0]->name) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                            <input type="text" name="references[0][designation]" value="{{ old('references[0][designation]', $student->references[0]->designation) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contact No.</label>
                            <input type="text" name="references[0][contact_no]" value="{{ old('references[0][contact_no]', $student->references[0]->contact_no) }}" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addReference()" class="text-blue-600 hover:text-blue-800 text-sm">+ Add Another Reference</button>
            </div>

            {{-- Admission Details --}}
            <div class="mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Admission Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Admission Date *</label>
                        <input type="date" name="admission_date" value="{{ old('admission_date', $student->admission_date) }}"
                               class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Assign Room</label>
                        <select name="room_id" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md">
                            <option value="">Select Room</option>
                            @foreach($available_rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id', $student->room_id) == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_number }} ({{ $room->capacity - $room->occupied }} spaces available)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Photo</label>
                        <input type="file" name="photo" class="h-12 px-3 block w-full rounded-lg border-gray-300 shadow-md">
                        @if($student->photo)
                            <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" class="mt-2 h-16 rounded">
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.students.index') }}" 
                   class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                    Update Student
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let qualificationIndex = 1;
let experienceIndex = 1;
let referenceIndex = 1;

// Add Qualification
function addQualification() {
    const container = document.getElementById('qualifications-container');
    const newRow = document.createElement('div');
    newRow.className = 'qualification-row grid grid-cols-1 md:grid-cols-7 gap-4 mb-4 p-4 border rounded-lg';
    newRow.innerHTML = `
        <div>
            <select name="qualifications[${qualificationIndex}][degree_type]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
                <option value="">Select</option>
                <option value="SSC">SSC</option>
                <option value="HSSC">HSSC</option>
                <option value="Bachelor">Bachelor</option>
                <option value="Masters">Masters</option>
                <option value="MS/M.Phil">MS/M.Phil</option>
                <option value="Ph.D">Ph.D</option>
            </select>
        </div>
        <div>
            <input type="number" step="0.1" name="qualifications[${qualificationIndex}][duration_years]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="text" name="qualifications[${qualificationIndex}][specialization]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="number" min="1950" max="2030" name="qualifications[${qualificationIndex}][passing_year]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="text" name="qualifications[${qualificationIndex}][cgpa_grade]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="text" name="qualifications[${qualificationIndex}][institute_board_university]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="text" name="qualifications[${qualificationIndex}][country]" value="Pakistan" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
            <button type="button" onclick="this.closest('.qualification-row').remove()" class="text-red-600 hover:text-red-800 text-xs mt-1">Remove</button>
        </div>
    `;
    container.appendChild(newRow);
    qualificationIndex++;
}

// Add Experience
function addExperience() {
    const container = document.getElementById('experience-container');
    const newRow = document.createElement('div');
    newRow.className = 'experience-row grid grid-cols-1 md:grid-cols-5 gap-4 mb-4 p-4 border rounded-lg';
    newRow.innerHTML = `
        <div>
            <input type="text" name="experiences[${experienceIndex}][institution_organization]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="text" name="experiences[${experienceIndex}][position_job_title]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="date" name="experiences[${experienceIndex}][from_date]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="date" name="experiences[${experienceIndex}][to_date]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="number" name="experiences[${experienceIndex}][total_period_months]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
            <button type="button" onclick="this.closest('.experience-row').remove()" class="text-red-600 hover:text-red-800 text-xs mt-1">Remove</button>
        </div>
    `;
    container.appendChild(newRow);
    experienceIndex++;
}

// Add Reference
function addReference() {
    const container = document.getElementById('references-container');
    const newRow = document.createElement('div');
    newRow.className = 'reference-row grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 p-4 border rounded-lg';
    newRow.innerHTML = `
        <div>
            <input type="text" name="references[${referenceIndex}][name]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="text" name="references[${referenceIndex}][designation]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
        </div>
        <div>
            <input type="text" name="references[${referenceIndex}][contact_no]" class="h-10 px-2 block w-full rounded border-gray-300 text-sm">
            <button type="button" onclick="this.closest('.reference-row').remove()" class="text-red-600 hover:text-red-800 text-xs mt-1">Remove</button>
        </div>
    `;
    container.appendChild(newRow);
    referenceIndex++;
}
</script>
@endsection
