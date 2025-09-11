<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\JapaneseAcademyStudent;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceExport;
use Barryvdh\DomPDF\Facade\Pdf;


class AttendanceController extends Controller
{
    // Show grid to mark attendance for a date+session
public function create(Request $request)
{
    $date = $request->input('date', now()->toDateString());
    $session = $request->input('session', 'Morning');
    $studentType = $request->input('student_type'); // 👈 new filter

    $studentsQuery = JapaneseAcademyStudent::orderBy('name')->select('id','name','student_type');

    if ($studentType) {
        $studentsQuery->where('student_type', $studentType);
    }

    $students = $studentsQuery->get();
    $teachers = Teacher::orderBy('name')->get(['id','name']);

    // Fetch existing marks for quick prefill
    $existing = Attendance::whereDate('date', $date)
        ->where('session', $session)
        ->get()
        ->groupBy(function ($a) { 
            return $a->attendable_type.'#'.$a->attendable_id; 
        });

    return view('attendance.mark', compact('date','session','students','teachers','existing','studentType'));
}


    // Store bulk marks for both students and teachers
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required','date'],
            'session' => ['required','string','max:100'],
            'students' => ['array'],
            'teachers' => ['array'],
            'student_types' => ['array'], // ✅ new input for student types
        ]);

        $date = $validated['date'];
        $session = $validated['session'];

        // Students
        foreach (($validated['students'] ?? []) as $id => $status) {
            Attendance::updateOrCreate([
            'date' => $date,
            'session' => $session,
            'attendable_type' => JapaneseAcademyStudent::class,
            'attendable_id' => $id,
        ], [
            'status' => $status === 'Present' ? 'Present' : 'Absent',
            'student_type' => $validated['student_types'][$id] ?? 'Physical',
        ]);

        }


        // Teachers
        foreach (($validated['teachers'] ?? []) as $id => $status) {
            Attendance::updateOrCreate([
                'date' => $date,
                'session' => $session,
                'attendable_type' => Teacher::class,
                'attendable_id' => $id,
            ], [
                'status' => $status === 'Present' ? 'Present' : 'Absent',
            ]);
        }

        return redirect()->route('admin.attendance.create', ['date' => $date, 'session' => $session,'student_type' => $request->student_type, ])
            ->with('status', 'Attendance saved.');
    }

public function daily(Request $request)
{
    $date = $request->input('date', now()->toDateString());
    $filterType = $request->input('filter_type', 'all');
    $studentMode = $request->input('student_mode', 'all');

    // Base query
    $query = Attendance::with('attendable')
        ->whereDate('date', $date)
        ->orderBy('session');

    // Apply type filter
    if ($filterType == 'teachers') {
        $query->whereHasMorph('attendable', 'App\\Models\\Teacher');
    } elseif ($filterType == 'students') {
        $query->whereHasMorph('attendable', 'App\\Models\\JapaneseAcademyStudent');
    }

    // ✅ Apply student_mode filter independently
    if ($studentMode !== 'all') {
        $query->whereHasMorph('attendable', 'App\\Models\\JapaneseAcademyStudent', function ($q) use ($studentMode) {
            $q->where('student_type', $studentMode);
        });
    }

    $records = $query->get();

    return view('attendance.daily', compact('date', 'records'));
}



    // Monthly report (group by day+session)
// AttendanceController
public function monthly(Request $request)
{
    $month = $request->input('month', now()->format('Y-m'));
    [$y, $m] = explode('-', $month);

    $start = Carbon::createFromDate((int)$y, (int)$m, 1)->startOfDay();
    $end   = (clone $start)->endOfMonth();

    $query = Attendance::with('attendable')
        ->whereBetween('date', [$start->toDateString(), $end->toDateString()]);

    // filter online / physical students
    if ($request->filled('student_mode')) {
        $query->where('student_type', $request->student_mode);
    }

    $records = $query->orderBy('date')
                     ->orderBy('session')
                     ->get();

    return view('attendance.monthly', compact('month','records'));
}



 public function exportExcel(Request $request)
    {
        try {
            $month = $request->input('month', now()->format('Y-m'));
            return Excel::download(new AttendanceExport($month), "attendance_$month.xlsx");
        } catch (\Exception $e) {
            return back()->with('error', 'Excel export failed: ' . $e->getMessage());
        }
    }

    public function exportPDF(Request $request)
    {
        try {
            $month = $request->input('month', now()->format('F Y'));
            [$y, $m] = explode('-', $month);
            $start = \Carbon\Carbon::createFromDate((int)$y, (int)$m, 1)->startOfDay();
            $end = (clone $start)->endOfMonth();

            $records = Attendance::with('attendable')
                ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
                ->orderBy('date')
                ->orderBy('session')
                ->get();

            $pdf = Pdf::loadView('attendance.pdf', compact('records', 'month'));
            return $pdf->download("attendance_$month.pdf");
        } catch (\Exception $e) {
            return back()->with('error', 'PDF export failed: ' . $e->getMessage());
        }
    }
}