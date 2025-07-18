<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Guest Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center text-center px-4">
    <div class="bg-white p-8 rounded shadow w-full max-w-2xl">
        <h1 class="text-2xl font-bold mb-4">🎓 Welcome to ExamPrep</h1>
        <p class="mb-4 text-gray-600">
            You're viewing the guest dashboard. Please
            <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a> or
            <a href="{{ route('register') }}" class="text-blue-600 underline">Register</a> for full access.
        </p>


        <h2 class="text-xl font-semibold mb-2">📘 Upcoming Public Exams</h2>

        @forelse ($upcomingExams as $exam)
            <div class="border-b py-2 text-left">
                <p class="font-medium">{{ $exam->title }} ({{ $exam->subject }})</p>
                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y H:i') }}</p>
            </div>
        @empty
            <p class="text-gray-500">No upcoming exams available.</p>
        @endforelse
    </div>
</body>

</html>
