@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-2">
    <!-- Header Section with Icon -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center">
                <div class="bg-primary rounded-circle p-3 me-3">
                    <i class="fas fa-calendar-check text-white fs-4"></i>
                </div>
                <div>
                    <h2 class="mb-1 text-dark fw-bold">Daily Attendance Report</h2>
                    <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

<!-- Date Filter Card -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="date" class="form-label fw-semibold">
                    <i class="fas fa-calendar-alt me-2 text-primary"></i>Select Date
                </label>
                <input type="date" id="date" name="date" value="{{ $date }}" 
                       class="form-control form-control-lg border-2">
            </div>
            <div class="col-md-3">
                <label for="filter_type" class="form-label fw-semibold">
                    <i class="fas fa-filter me-2 text-success"></i>Filter by Type
                </label>
                <select id="filter_type" name="filter_type" class="form-select form-control-lg form-select-lg border-2">
                    <option value="all" {{ request('filter_type', 'all') == 'all' ? 'selected' : '' }}>
                        🔍 All Records
                    </option>
                    <option value="teachers" {{ request('filter_type') == 'teachers' ? 'selected' : '' }}>
                        👨‍🏫 Teachers Only
                    </option>
                    <option value="students" {{ request('filter_type') == 'students' ? 'selected' : '' }}>
                        👨‍🎓 Students Only
                    </option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-search me-2"></i>Filter
                </button>
            </div>
    
        </form>
    </div>
</div>

<!-- Filter Status Info -->
@if(request('filter_type') && request('filter_type') != 'all')
<div class="alert alert-info border-0 shadow-sm mb-4">
    <div class="d-flex align-items-center">
        <i class="fas fa-info-circle me-3 fs-5"></i>
        <div class="flex-grow-1">
            <strong>Active Filter:</strong> 
            Showing only 
            @if(request('filter_type') == 'teachers')
                <span class="badge bg-primary px-2 py-1">👨‍🏫 Teachers</span>
            @else
                <span class="badge bg-info px-2 py-1">👨‍🎓 Students</span>
            @endif
            records for {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
        </div>
        <a href="?date={{ $date }}&filter_type=all" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-eye me-1"></i>View All Records
        </a>
    </div>
</div>
@endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 bg-success text-white">
                <div class="card-body py-2 px-3">

                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Present</h6>
                            <h3 class="mb-0">{{ $records->where('status', 'Present')->count() }}</h3>
                        </div>
                        <i class="fas fa-user-check fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 bg-danger text-white">
                <div class="card-body py-2 px-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Absent</h6>
                            <h3 class="mb-0">{{ $records->where('status', 'Absent')->count() }}</h3>
                        </div>
                        <i class="fas fa-user-times fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 bg-warning text-white">
              <div class="card-body py-2 px-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Late</h6>
                            <h3 class="mb-0">{{ $records->where('status', 'Late')->count() }}</h3>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 bg-info text-white">
                <div class="card-body py-2 px-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Records</h6>
                            <h3 class="mb-0">{{ $records->count() }}</h3>
                        </div>
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-2 border-primary">
            <h5 class="mb-0 d-flex align-items-center">
                <i class="fas fa-list-alt me-2 text-primary"></i>
                Attendance Details
            </h5>
        </div>
        <div class="card-body p-0">
            @if($records->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="fw-semibold text-dark">
                                    <i class="fas fa-calendar-day me-2 text-muted"></i>Date
                                </th>
                                <th class="fw-semibold text-dark">
                                    <i class="fas fa-clock me-2 text-muted"></i>Session
                                </th>
                                <th class="fw-semibold text-dark">
                                    <i class="fas fa-tag me-2 text-muted"></i>Type
                                </th>
                                <th class="fw-semibold text-dark">
                                    <i class="fas fa-user me-2 text-muted"></i>Name
                                </th>
                                <th class="fw-semibold text-dark">
                                    <i class="fas fa-check-circle me-2 text-muted"></i>Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $r)
                                <tr class="align-middle">
                                    <td class="fw-medium">{{ $r->date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $r->session }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ class_basename($r->attendable_type) }}
                                        </span>
                                    </td>
                                    <td class="fw-medium">{{ $r->attendable->name ?? '-' }}</td>
                                    <td>
                                        @switch($r->status)
                                            @case('Present')
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check me-1"></i>Present
                                                </span>
                                                @break
                                            @case('Absent')
                                                <span class="badge bg-danger px-3 py-2">
                                                    <i class="fas fa-times me-1"></i>Absent
                                                </span>
                                                @break
                                            @case('Late')
                                                <span class="badge bg-warning px-3 py-2">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>Late
                                                </span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary px-3 py-2">
                                                    {{ $r->status }}
                                                </span>
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No attendance records found</h5>
                    <p class="text-muted">Please select a different date or check if data is available.</p>
                </div>
            @endif
        </div>
    </div>

</div>

<style>
.border-2 {
    border-width: 2px !important;
}

.border-primary {
    border-color: var(--bs-primary) !important;
}

.border-bottom-2 {
    border-bottom-width: 2px !important;
}

.table th {
    border-top: none;
    padding: 1rem 0.75rem;
    background-color: #f8f9fa;
}

.table td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.85em;
    font-weight: 500;
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 0 15px;
    }
    
    .stats-card .card-body {
        padding: 0.5rem 0.75rem; /* default 1rem hota hai */
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .d-flex.gap-2 {
        flex-wrap: wrap;
    }
    
    .d-flex.gap-2 .btn {
        flex: 1;
        min-width: 120px;
        margin-bottom: 0.5rem;
    }
}
</style>

<!-- Add Font Awesome if not already included -->
@if(!isset($fontAwesome))
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endif
@endsection