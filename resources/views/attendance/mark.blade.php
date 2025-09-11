@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <!-- Header Section -->
    <div class="d-flex align-items-center mb-4">
        <i class="fas fa-clipboard-check text-primary me-3" style="font-size: 2rem;"></i>
        <div>
            <h2 class="mb-1 text-primary">Mark Attendance</h2>
            <p class="text-muted mb-0">Track student and teacher attendance efficiently</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Date and Session Filter Card -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">
            <i class="fas fa-calendar-alt me-2"></i>
            Select Date, Session & Student Type
        </h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.attendance.create') }}" class="row g-3">
            <!-- Date -->
            <div class="col-md-3">
                <label for="date" class="form-label">Date</label>
                <input type="date"
                       id="date"
                       name="date"
                       value="{{ request('date', $date ?? '') }}"
                       class="form-control form-control-lg">
            </div>

            <!-- Session -->
            <div class="col-md-3">
                <label for="session" class="form-label">Session</label>
                <input type="text"
                       id="session"
                       name="session"
                       value="{{ request('session', $session ?? '') }}"
                       class="form-control form-control-lg"
                       placeholder="e.g., Morning, Afternoon">
            </div>

            <!-- Student Type -->
            <div class="col-md-3">
                <label for="student_type" class="form-label">Student Type</label>
                <select id="student_type" name="student_type" class="form-control form-control-lg">
                    <option value="">🎯 All</option>
                    <option value="online" {{ $studentType === 'online' ? 'selected' : '' }}>🌐 Online</option>
                    <option value="physical" {{ $studentType === 'physical' ? 'selected' : '' }}>🏫 Physical</option>

                </select>
            </div>

            <!-- Submit -->
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-outline-primary btn-lg w-100">
                    <i class="fas fa-search me-2"></i>Load Attendance
                </button>
            </div>
        </form>
    </div>
</div>



    <!-- Attendance Form -->
    <form method="POST" action="{{ route('admin.attendance.store') }}">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="hidden" name="session" value="{{ $session }}">
        @foreach($students as $s)
            <input type="hidden" name="student_types[{{ $s->id }}]" value="{{ $studentType }}">
        @endforeach


        <!-- Current Session Info -->
        <div class="alert alert-info mb-4">
            <div class="row">
                <div class="col-md-6">
                    <strong><i class="fas fa-calendar me-2"></i>Date:</strong> {{ date('l, F j, Y', strtotime($date)) }}
                </div>
                <div class="col-md-6">
                    <strong><i class="fas fa-clock me-2"></i>Session:</strong> {{ $session }}
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Students Section -->
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-graduate me-2"></i>
                            Students 
                            <span class="badge bg-light text-success ms-2">{{ count($students) }}</span>
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Name</th>
                                        <th class="text-center">
                                            <i class="fas fa-check text-success me-1"></i>Present
                                        </th>
                                        <th class="text-center">
                                            <i class="fas fa-times text-danger me-1"></i>Absent
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $s)
                                        @php
                                            $key = App\Models\JapaneseAcademyStudent::class.'#'.$s->id;
                                            $prefill = $existing[$key][0]->status ?? null;
                                        @endphp
                                        <tr class="student-row">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-success-subtle rounded-circle d-flex align-items-center justify-content-center me-3">
                                                        <i class="fas fa-user text-success"></i>
                                                    </div>
                                                    <strong>{{ $s->name }}</strong>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input type="radio" 
                                                           class="form-check-input status-radio present-radio" 
                                                           name="students[{{ $s->id }}]" 
                                                           value="Present" 
                                                           id="student_{{ $s->id }}_present"
                                                           {{ $prefill === 'Present' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="student_{{ $s->id }}_present"></label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input type="radio" 
                                                           class="form-check-input status-radio absent-radio" 
                                                           name="students[{{ $s->id }}]" 
                                                           value="Absent" 
                                                           id="student_{{ $s->id }}_absent"
                                                           {{ $prefill === 'Absent' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="student_{{ $s->id }}_absent"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teachers Section -->
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chalkboard-teacher me-2"></i>
                            Teachers 
                            <span class="badge bg-light text-primary ms-2">{{ count($teachers) }}</span>
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Name</th>
                                        <th class="text-center">
                                            <i class="fas fa-check text-success me-1"></i>Present
                                        </th>
                                        <th class="text-center">
                                            <i class="fas fa-times text-danger me-1"></i>Absent
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teachers as $t)
                                        @php
                                            $key = App\Models\Teacher::class.'#'.$t->id;
                                            $prefill = $existing[$key][0]->status ?? null;
                                        @endphp
                                        <tr class="teacher-row">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-3">
                                                        <i class="fas fa-user-tie text-primary"></i>
                                                    </div>
                                                    <strong>{{ $t->name }}</strong>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input type="radio" 
                                                           class="form-check-input status-radio present-radio" 
                                                           name="teachers[{{ $t->id }}]" 
                                                           value="Present" 
                                                           id="teacher_{{ $t->id }}_present"
                                                           {{ $prefill === 'Present' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="teacher_{{ $t->id }}_present"></label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input type="radio" 
                                                           class="form-check-input status-radio absent-radio" 
                                                           name="teachers[{{ $t->id }}]" 
                                                           value="Absent" 
                                                           id="teacher_{{ $t->id }}_absent"
                                                           {{ $prefill === 'Absent' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="teacher_{{ $t->id }}_absent"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-save me-2"></i>Save Attendance
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .avatar-sm {
        width: 32px;
        height: 32px;
    }

    .student-row:hover, .teacher-row:hover {
        background-color: #f8f9fa;
    }

    .status-radio {
        transform: scale(1.2);
    }

    .present-radio:checked {
        background-color: #28a745;
        border-color: #28a745;
    }

    .absent-radio:checked {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1);
    }

    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1);
    }
</style>
@endpush

@endsection