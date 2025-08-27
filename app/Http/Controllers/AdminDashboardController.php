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





class AdminDashboardController extends Controller
{
    public function adminsidebar()
    {
        
        return view('layouts.admin');
    }
    public function admindashboard()
    {
            $stats = [
            'total_students' => Student::where('status', 'active')->count(),
            'occupied_rooms' => Room::sum('occupied'),
            'total_rooms' => Room::count(),
            'academy_students' => JapaneseAcademyStudent::where('status', 'enrolled')->count(),
            'mess_members' => Mess_management::where('status', 'active')->count(),
            'pending_fees' => Fee_management::where('status', 'pending')->sum('amount'),
            'monthly_revenue' => Fee_management::where('status', 'paid')->whereMonth('paid_date', now()->month)
                        ->sum('paid_amount')
        ];

        $recent_admissions = Student::with('roomAssignment.room')
                                   ->orderBy('admission_date', 'desc')
                                   ->limit(5)
                                   ->get();

        $pending_payments = Student::with('pendingFees')
                                  ->whereHas('pendingFees')
                                  ->limit(10)
                                  ->get();

        return view('admin.dashboard', compact('stats', 'recent_admissions', 'pending_payments'));
    
    }
}
