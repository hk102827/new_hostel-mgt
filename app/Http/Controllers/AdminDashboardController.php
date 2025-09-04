<?php

namespace App\Http\Controllers;

use App\Models\JapaneseAcademyStudent;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Room;
use App\Models\Room_assignment; 
use App\Models\Japanese_academy;
use App\Models\Mess_management;
use App\Models\Fee_management;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function adminsidebar()
    {
        return view('layouts.admin');
    }

public function admindashboard()
{
    $total_fees = Fee_management::sum('amount');
    $total_paid  = Fee_management::sum('paid_amount');

    $now = now();

    $last6Months = collect(range(0, 5))->map(function ($i) use ($now) {
        $month = $now->copy()->subMonths($i);

        // month range (include whole day)
        $start = $month->copy()->startOfMonth()->startOfDay();
        $end   = $month->copy()->endOfMonth()->endOfDay();

        // Revenue: payments whose paid_date falls inside this month
        $revenue = Fee_management::whereBetween('paid_date', [$start, $end])
            ->sum('paid_amount');

        $pending = Fee_management::whereBetween('paid_date', [$start, $end])
            ->whereColumn('paid_amount', '<', 'amount')
            ->sum(DB::raw('amount - paid_amount'));

        return [
            'month' => $month->format('M Y'),
            'revenue' => (float) $revenue,
            'pending' => (float) $pending,
        ];
    })->reverse()->values();

    // current month range
        $currentStart = $now->copy()->startOfMonth()->startOfDay();
        $currentEnd   = $now->copy()->endOfMonth()->endOfDay();

        // ✅ Monthly revenue: total paid_amount jinki paid_date current month me hai
        $monthly_revenue = Fee_management::whereBetween('paid_date', [$currentStart, $currentEnd])
            ->sum('paid_amount');

        if ($monthly_revenue == 0) {
            $monthly_revenue = Fee_management::whereBetween('created_at', [$currentStart, $currentEnd])
                ->sum('paid_amount');
        }

    $stats = [
        'total_students'   => Student::where('status', 'active')->count(),
        'occupied_rooms'   => Room::sum('occupied'),
        'total_rooms'      => Room::count(),
        'academy_students' => JapaneseAcademyStudent::where('status', 'active')->count(),
        'mess_members'     => Mess_management::where('status', 'active')->count(),
        'pending_fees'     => Fee_management::sum(DB::raw('amount - paid_amount')),
        'pending_count'    => Fee_management::whereColumn('paid_amount', '<', 'amount')->count(),
        'monthly_revenue'  => (float) $monthly_revenue,
        'collection_rate'  => $total_fees > 0 ? round(($total_paid / $total_fees) * 100, 2) : 0,

        'last6Months'      => $last6Months,
    ];

    $recent_admissions = Student::with('roomAssignment.room')
        ->orderBy('admission_date', 'desc')
        ->limit(5)
        ->get();

    $pending_payments = Student::with('fees')
        ->whereHas('fees', function($q) {
            $q->whereColumn('amount', '>', 'paid_amount');
        })
        ->limit(10)
        ->get();

    return view('admin.dashboard', compact('stats', 'recent_admissions', 'pending_payments'));
}




    // Dashboard: student details view
    public function show($id)
    {
        $student = Student::with([
            'roomAssignment.room',    // current room assignment with room info
            'japaneseAcademy',
            'messManagement',
            'fees'                    // all fees
        ])->findOrFail($id);
        // dd($student);

        // Split fees into helpful buckets
        $pendingFees = $student->fees()->whereIn('status', ['pending', 'overdue','partial'])->orderByDesc('due_date')->get();
        $paidFees = $student->fees()->where('status', 'paid')->orderByDesc('paid_date')->get();

        // Totals and balance
        $totalAmount = (float) $student->fees()->sum('amount');
        $totalPaid = (float) $student->fees()->sum('paid_amount');
        $balance = max($totalAmount - $totalPaid, 0);
        

        return view('admin.student-details', compact('student', 'pendingFees', 'paidFees', 'totalAmount', 'totalPaid', 'balance'));
    }
}
