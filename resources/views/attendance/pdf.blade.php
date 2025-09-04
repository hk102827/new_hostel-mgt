<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report - {{ $month }}</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Attendance Report - {{ $month }}</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Session</th>
                <th>Type</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($records as $r)
            <tr>
                <td>{{ $r->date->format('Y-m-d') }}</td>
                <td>{{ $r->session }}</td>
                <td>{{ class_basename($r->attendable_type) }}</td>
                <td>{{ $r->attendable->name ?? '-' }}</td>
                <td>{{ $r->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
