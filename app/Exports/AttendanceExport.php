<?php

namespace App\Exports;

use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function collection()
    {
        [$y, $m] = explode('-', $this->month);
        $start = Carbon::createFromDate((int)$y, (int)$m, 1)->startOfDay();
        $end = (clone $start)->endOfMonth();

        return Attendance::with('attendable')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->orderBy('date')
            ->orderBy('session')
            ->get();
    }

    // 👇 Excel ke liye heading row
    public function headings(): array
    {
        return [
            'Date',
            'Session',
            'Name',
            'student_type',
            'Type',
            'Status',
        ];
    }

    // 👇 Har record ko readable banane ke liye map
    public function map($attendance): array
    {
        return [
            Carbon::parse($attendance->date)->format('d-m-Y'),  // readable date
            $attendance->session,
            optional($attendance->attendable)->name ?? '-',     // Student/Teacher ka naam
            optional($attendance->attendable)->student_type ?? '-', // Student Type
            class_basename($attendance->attendable_type),       // sirf model ka short name
            $attendance->status,
        ];
    }
}
