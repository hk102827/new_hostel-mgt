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

        $students = JapaneseAcademyStudent::orderBy('name')->get(['id','name']);
        $teachers = Teacher::orderBy('name')->get(['id','name']);

        // Fetch existing marks for quick prefill
        $existing = Attendance::whereDate('date', $date)
            ->where('session', $session)
            ->get()
            ->groupBy(function ($a) { return $a->attendable_type.'#'.$a->attendable_id; });

        return view('attendance.mark', compact('date','session','students','teachers','existing'));
    }

    // Store bulk marks for both students and teachers
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required','date'],
            'session' => ['required','string','max:100'],
            'students' => ['array'],
            'teachers' => ['array'],
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

        return redirect()->route('admin.attendance.create', ['date' => $date, 'session' => $session])
            ->with('status', 'Attendance saved.');
    }

    // Daily summary with filtering
    public function daily(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $filterType = $request->input('filter_type', 'all');
        
        // Base query
        $query = Attendance::with('attendable')
            ->whereDate('date', $date)
            ->orderBy('session');
        
        // Apply filter based on type selection
        if ($filterType == 'teachers') {
            // Filter for teachers only
            $query->whereHasMorph('attendable', 'App\\Models\\Teacher');
        } elseif ($filterType == 'students') {
            // Filter for students only
            $query->whereHasMorph('attendable', 'App\\Models\\JapaneseAcademyStudent');
        }
        // If 'all', no additional filtering needed
        
        $records = $query->get();
        
        return view('attendance.daily', compact('date', 'records'));
    }

    // Monthly report (group by day+session)
    public function monthly(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        // parse month to first/last day
        [$y, $m] = explode('-', $month);
        $start = Carbon::createFromDate((int)$y, (int)$m, 1)->startOfDay();
        $end = (clone $start)->endOfMonth();

        $records = Attendance::with('attendable')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->orderBy('date')
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
            $month = $request->input('month', now()->format('Y-m'));
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