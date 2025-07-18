<h1>Student Dashboard</h1>
<h3>Upcoming Exams</h3>
<ul>
    @foreach ($upcomingExams as $exam)
        <li>{{ $exam->title }} - {{ $exam->exam_date }}</li>
    @endforeach
</ul>

<h3>Recent Results</h3>
<ul>
    @foreach ($results as $result)
        <li>{{ $result->subject }}: {{ $result->marks }}%</li>
    @endforeach
</ul>
