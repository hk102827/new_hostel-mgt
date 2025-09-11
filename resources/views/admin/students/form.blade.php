@extends('layouts.admin')

@section('title', 'Admission Form')
@section('page-title', 'Student Admission Form')

@section('content')
<div class="relative border-2 border-gray-800 p-10 rounded-xl shadow-xl bg-white print:border-black">
    
    <!-- Watermark -->
    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
        <img src="{{ asset('assets/image/logo5.png') }}" alt="Logo" class="w-[400px] h-[400px] object-contain">
    </div>

    <div class="relative bg-white p-6 rounded-lg text-sm print:p-0">
        
        <!-- Print Button -->
        <div class="flex justify-end mb-4 print:hidden">
            <button onclick="window.print()" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700">
                Print Form
            </button>
        </div>

        <!-- Header -->
        <div class="flex items-start mb-6 border-b pb-4">
            <div class="flex-1 text-center">
                <h2 class="font-bold text-lg uppercase">Tokyo Japanese Language School (Private) Limited</h2>
                <p class="text-xs">Station (Tick only one): Islamabad / Lahore / Karachi</p>
                <p class="text-xs">Job Applied For: _____________________ (Permanent)</p>
            </div>
            <div class="w-28 h-32 border border-gray-400 flex items-center justify-center ml-4">
                @if($student->photo)
                    <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" class="w-full h-full object-cover">
                @else
                    <span class="text-xs text-gray-500">Photo</span>
                @endif
            </div>
        </div>

        <!-- Personal Info -->
        <h3 class="bg-gray-200 text-gray-800 font-bold px-2 py-1 mb-2">1. Personal Information</h3>
        <table class="w-full border border-gray-700 text-xs">
            <tr>
                <td class="border p-2 w-32 font-medium">Name</td>
                <td class="border p-2">{{ $student->name }}</td>
                <td class="border p-2 font-medium">Father’s Name</td>
                <td class="border p-2">{{ $student->father_name }}</td>
            </tr>
            <tr class="bg-gray-50">
                <td class="border p-2 font-medium">CNIC</td>
                <td class="border p-2">{{ $student->cnic }}</td>
                <td class="border p-2 font-medium">Date of Birth</td>
                <td class="border p-2">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="border p-2 font-medium">Tel/Cell No</td>
                <td class="border p-2">{{ $student->phone }}</td>
                <td class="border p-2 font-medium">Email</td>
                <td class="border p-2">{{ $student->email }}</td>
            </tr>
            <tr class="bg-gray-50">
                <td class="border p-2 font-medium">Nationality</td>
                <td class="border p-2">{{ $student->nationality }}</td>
                <td class="border p-2 font-medium">Religion</td>
                <td class="border p-2">{{ $student->religion }}</td>
            </tr>
            <tr>
                <td class="border p-2 font-medium">Postal Address</td>
                <td colspan="3" class="border p-2">{{ $student->address }}</td>
            </tr>
        </table>

        <!-- Qualification -->
        <h3 class="bg-gray-200 text-gray-800 font-bold px-2 py-1 mt-6 mb-2">2. Qualification</h3>
        <table class="w-full border border-gray-700 text-xs">
            <tr class="bg-gray-100 font-bold">
                <td class="border p-2">Certificate/Degree</td>
                <td class="border p-2">Duration</td>
                <td class="border p-2">Specialization</td>
                <td class="border p-2">Passing Year</td>
                <td class="border p-2">CGPA/%</td>
                <td class="border p-2">Institute/Board/University</td>
                <td class="border p-2">Country</td>
            </tr>
            @foreach($student->qualifications as $q)
            <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                <td class="border p-2">{{ $q->degree_type }}</td>
                <td class="border p-2">{{ $q->duration_years }}</td>
                <td class="border p-2">{{ $q->specialization }}</td>
                <td class="border p-2">{{ $q->passing_year }}</td>
                <td class="border p-2">{{ $q->cgpa_grade }}</td>
                <td class="border p-2">{{ $q->institute_board_university }}</td>
                <td class="border p-2">{{ $q->country }}</td>
            </tr>
            @endforeach
        </table>

        <!-- Experience -->
        <h3 class="bg-gray-200 text-gray-800 font-bold px-2 py-1 mt-6 mb-2">3. Experience</h3>
        <table class="w-full border border-gray-700 text-xs">
            <tr class="bg-gray-100 font-bold">
                <td class="border p-2">Institution/Organization</td>
                <td class="border p-2">Position</td>
                <td class="border p-2">From</td>
                <td class="border p-2">To</td>
                <td class="border p-2">Total Period</td>
            </tr>
            @foreach($student->experiences as $exp)
            <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                <td class="border p-2">{{ $exp->institution_organization }}</td>
                <td class="border p-2">{{ $exp->position_job_title }}</td>
                <td class="border p-2">{{ \Carbon\Carbon::parse($exp->from_date)->format('d/m/Y') }}</td>
                <td class="border p-2">{{ \Carbon\Carbon::parse($exp->to_date)->format('d/m/Y') }}</td>
                <td class="border p-2">{{ $exp->total_period_months }}</td>
            </tr>
            @endforeach
        </table>

        <!-- References -->
        <h3 class="bg-gray-200 text-gray-800 font-bold px-2 py-1 mt-6 mb-2">4. References</h3>
        <table class="w-full border border-gray-700 text-xs">
            <tr class="bg-gray-100 font-bold">
                <td class="border p-2">S.No</td>
                <td class="border p-2">Name</td>
                <td class="border p-2">Designation</td>
                <td class="border p-2">Contact No</td>
            </tr>
            @foreach($student->references as $ref)
            <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                <td class="border p-2">{{ $loop->iteration }}</td>
                <td class="border p-2">{{ $ref->name }}</td>
                <td class="border p-2">{{ $ref->designation }}</td>
                <td class="border p-2">{{ $ref->contact_no }}</td>
            </tr>
            @endforeach
        </table>

        <!-- Signature -->
        <div class="flex justify-between mt-12 text-sm">
            <div>Date: _____________________</div>
            <div>Signature: _____________________</div>
        </div>
    </div>
</div>
@endsection
