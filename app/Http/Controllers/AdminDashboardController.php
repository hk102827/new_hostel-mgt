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
    $total_paid = Fee_management::sum('paid_amount');

    $stats = [
        'total_students' => Student::where('status', 'active')->count(),
        'occupied_rooms' => Room::sum('occupied'),
        'total_rooms' => Room::count(),
        'academy_students' => JapaneseAcademyStudent::where('status', 'active')->count(),
        'mess_members' => Mess_management::where('status', 'active')->count(),

        // ✅ Total pending fees
        'pending_fees' => Fee_management::sum(DB::raw('amount - paid_amount')),

        // ✅ Monthly revenue (full + partial payments dono ka paid_amount add hoga)
        'monthly_revenue' => Fee_management::whereMonth('paid_date', now()->month)
            ->sum('paid_amount'),
                  // ✅ Collection Rate
        'collection_rate' => $total_fees > 0 
            ? round(($total_paid / $total_fees) * 100, 2) 
            : 0,
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
