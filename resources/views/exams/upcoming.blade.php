<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upcoming Exams</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>
    <h1>Upcoming Exams</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Subject</th>
            <th>Date/Time</th>
        </tr>
        @forelse ($exams as $exam)
            <tr>
                <td>{{ $exam->title }}</td>
                <td>{{ $exam->subject }}</td>
                <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y, H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No upcoming exams available.</td>
            </tr>
        @endforelse
    </table>
</body>

</html>
