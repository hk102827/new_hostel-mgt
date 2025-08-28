<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Room;
use App\Models\Fee_management;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportsController extends Controller
{
    // Show a simple reports index page with links
    public function index()
    {
        return view('admin.reports.index');
    }

    // Fee report page with filters
    public function fees(Request $request)
    {
        $status = $request->query('status'); // pending|paid|overdue
        $from = $request->query('from');
        $to = $request->query('to');

        $query = Fee_management::with('student')->orderByDesc('created_at');

        if ($status) {
            $query->where('status', $status);
        }
        if ($from) {
            $query->whereDate('due_date', '>=', $from);
        }
        if ($to) {
            $query->whereDate('due_date', '<=', $to);
        }

        $fees = $query->paginate(20)->appends($request->query());

        return view('admin.reports.fees', compact('fees', 'status', 'from', 'to'));
    }

    // Fee report CSV download (with same filters)
    public function feesDownload(Request $request): StreamedResponse
    {
        $status = $request->query('status');
        $from = $request->query('from');
        $to = $request->query('to');

        $fileName = 'fees_report_' . now()->format('Y_m_d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($status, $from, $to) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'ID', 'Student Name', 'Student ID', 'Fee Type', 'Amount', 'Paid Amount', 'Status', 'Due Date', 'Paid Date', 'Payment Method', 'Receipt Number', 'Notes', 'Created At'
            ]);

            $base = Fee_management::with('student');
            if ($status) $base->where('status', $status);
            if ($from) $base->whereDate('due_date', '>=', $from);
            if ($to) $base->whereDate('due_date', '<=', $to);

            $base->orderBy('id')->chunk(500, function ($fees) use ($handle) {
                foreach ($fees as $f) {
                    fputcsv($handle, [
                        $f->id,
                        optional($f->student)->name,
                        $f->student_id ?? optional($f->student)->id,
                        $f->fee_type ?? '',
                        $f->amount ?? '',
                        $f->paid_amount ?? '',
                        $f->status ?? '',
                        optional($f->due_date)->format('Y-m-d'),
                        optional($f->paid_date)->format('Y-m-d'),
                        $f->payment_method ?? '',
                        $f->receipt_number ?? '',
                        $f->notes ?? '',
                        optional($f->created_at)->format('Y-m-d'),
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Download combined CSV report
    public function download(Request $request): StreamedResponse
    {
        $type = $request->query('type', 'students'); // students | rooms | fees

        switch ($type) {
            case 'rooms':
                return $this->downloadRoomsCsv();
            case 'fees':
                return $this->downloadFeesCsv();
            case 'students':
            default:
                return $this->downloadStudentsCsv();
        }
    }

    protected function downloadStudentsCsv(): StreamedResponse
    {
        $fileName = 'students_report_' . now()->format('Y_m_d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            // CSV Header
            fputcsv($handle, [
                'ID', 'Name', 'Father Name', 'CNIC', 'Phone', 'Email', 'Address', 'Emergency Contact', 'Admission Date', 'Status',
            ]);

            Student::chunk(500, function ($students) use ($handle) {
                foreach ($students as $s) {
                    fputcsv($handle, [
                        $s->id,
                        $s->name,
                        $s->father_name,
                        $s->cnic,
                        $s->phone,
                        $s->email,
                        $s->address,
                        $s->emergency_contact,
                        optional($s->admission_date)->format('Y-m-d'),
                        $s->status,
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    protected function downloadRoomsCsv(): StreamedResponse
    {
        $fileName = 'rooms_report_' . now()->format('Y_m_d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            // CSV Header
            fputcsv($handle, [
                'ID', 'Room Number', 'Room Type', 'Capacity', 'Occupied', 'Rent', 'Status', 'Facilities'
            ]);

            Room::chunk(500, function ($rooms) use ($handle) {
                foreach ($rooms as $r) {
                    fputcsv($handle, [
                        $r->id,
                        $r->room_number,
                        $r->room_type,
                        $r->capacity,
                        $r->occupied,
                        $r->rent,
                        $r->status,
                        $r->facilities,
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    protected function downloadFeesCsv(): StreamedResponse
    {
        $fileName = 'fees_report_' . now()->format('Y_m_d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            // CSV Header aligned with Fee_management schema
            fputcsv($handle, [
                'ID', 'Student ID', 'Fee Type', 'Amount', 'Paid Amount', 'Status', 'Due Date', 'Paid Date', 'Payment Method', 'Receipt Number', 'Notes', 'Created At'
            ]);

            Fee_management::with('student')->chunk(500, function ($fees) use ($handle) {
                foreach ($fees as $f) {
                    fputcsv($handle, [
                        $f->id,
                        $f->student_id ?? optional($f->student)->id,
                        $f->fee_type ?? '',
                        $f->amount ?? '',
                        $f->paid_amount ?? '',
                        $f->status ?? '',
                        optional($f->due_date)->format('Y-m-d'),
                        optional($f->paid_date)->format('Y-m-d'),
                        $f->payment_method ?? '',
                        $f->receipt_number ?? '',
                        $f->notes ?? '',
                        optional($f->created_at)->format('Y-m-d'),
                    ]);
                }
            });

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}