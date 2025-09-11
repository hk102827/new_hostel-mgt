<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
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
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'cnic.regex' => 'CNIC format should be: 12345-6789012-3',
            'date_of_birth.before' => 'Date of birth must be before today.',
            'qualifications.*.passing_year.min' => 'Passing year should be after 1950.',
            'qualifications.*.passing_year.max' => 'Passing year should not exceed 2030.',
            'experiences.*.to_date.after_or_equal' => 'End date should be after or equal to start date.',
        ];
    }

    /**
     * Custom attribute names for error messages
     */
    public function attributes(): array
    {
        return [
            'father_name' => "father's name",
            'date_of_birth' => 'date of birth',
            'marital_status' => 'marital status',
            'postal_address' => 'postal address',
            'emergency_contact' => 'emergency contact',
            'job_type' => 'job type',
            'admission_date' => 'admission date',
            'room_id' => 'room assignment',
        ];
    }
}