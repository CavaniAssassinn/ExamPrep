<h1>Upcoming Exams</h1>
<table>
    <tr>
        <th>Title</th>
        <th>Subject</th>
        <th>Date/Time</th>
    </tr>
    @foreach ($exams as $exam)
        <tr>
            <td>{{ $exam->title }}</td>
            <td>{{ $exam->subject }}</td>
            <td>{{ $exam->exam_date }}</td>
        </tr>
    @endforeach
</table>
