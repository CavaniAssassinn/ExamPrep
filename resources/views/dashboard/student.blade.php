<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col justify-between">
            <div>
                <div class="p-6 text-xl font-bold text-gray-800">🎓 ExamPrep</div>
                <nav class="space-y-2">
                    <a href="#"
                        class="block px-6 py-2 bg-yellow-100 text-yellow-800 rounded-r-full font-medium">Dashboard</a>
                    <a href="{{ route('exams.upcoming') }}" class="block px-6 py-2 hover:bg-gray-100">📘 Exams</a>
                    <a href="{{ route('results') }}" class="block px-6 py-2 hover:bg-gray-100">📊 Results</a>
                </nav>
            </div>
            <div class="p-6 border-t space-y-2">
                <a href="/profile" class="block bg-blue-500 hover:bg-blue-600 text-white text-center px-4 py-2 rounded">
                    👤 Profile
                </a>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <div>
                    @auth
                        <h1 class="text-2xl font-semibold text-gray-800">Welcome, {{ auth()->user()->name }} 🎉</h1>
                    @else
                        <a href="/login" class="text-blue-600 underline">Login</a> |
                        <a href="/register" class="text-blue-600 underline">Register</a>
                    @endauth
                </div>
                <div class="space-x-3">
                    @if (auth()->user()->user_role === 'lecturer')
                        <a href="/exams/create"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded inline-block">
                            + New Exam
                        </a>
                    @endif
                </div>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Calendar -->
                <script>
                    const upcomingExams = @json(
                        $upcomingExams->pluck('exam_date')->map(function ($date) {
                            return \Carbon\Carbon::parse($date)->format('Y-m-d');
                        }));
                </script>

                <!-- Calendar -->
                <div class="bg-white rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-3">📅 Calendar</h2>
                    <div id="calendar" class="grid grid-cols-7 gap-1 text-center text-sm">
                        <div class="font-bold text-gray-700">Sun</div>
                        <div class="font-bold text-gray-700">Mon</div>
                        <div class="font-bold text-gray-700">Tue</div>
                        <div class="font-bold text-gray-700">Wed</div>
                        <div class="font-bold text-gray-700">Thu</div>
                        <div class="font-bold text-gray-700">Fri</div>
                        <div class="font-bold text-gray-700">Sat</div>
                        <!-- Dates will be populated here -->
                    </div>
                </div>

                <script>
                    const calendarEl = document.getElementById('calendar');

                    const now = new Date();
                    const year = now.getFullYear();
                    const month = now.getMonth(); // 0-indexed
                    const today = now.getDate();

                    const firstDayOfMonth = new Date(year, month, 1).getDay(); // Sunday = 0
                    const daysInMonth = new Date(year, month + 1, 0).getDate();

                    // Convert to set for quick lookup
                    const examDates = new Set(upcomingExams.filter(dateStr => {
                        const d = new Date(dateStr);
                        return d.getFullYear() === year && d.getMonth() === month;
                    }).map(dateStr => new Date(dateStr).getDate()));

                    // Fill blank days
                    for (let i = 0; i < firstDayOfMonth; i++) {
                        const empty = document.createElement('div');
                        calendarEl.appendChild(empty);
                    }

                    // Fill actual days
                    for (let day = 1; day <= daysInMonth; day++) {
                        const dayEl = document.createElement('div');
                        dayEl.textContent = day;
                        dayEl.classList.add('py-1', 'rounded', 'cursor-default', 'transition');

                        const isToday = day === today;
                        const isExam = examDates.has(day);

                        if (isToday && isExam) {
                            dayEl.classList.add('bg-purple-500', 'text-white', 'font-bold');
                        } else if (isToday) {
                            dayEl.classList.add('bg-yellow-400', 'text-white', 'font-bold');
                        } else if (isExam) {
                            dayEl.classList.add('bg-blue-500', 'text-white', 'font-semibold');
                        } else {
                            dayEl.classList.add('hover:bg-gray-100');
                        }

                        calendarEl.appendChild(dayEl);
                    }
                </script>



                <!-- Upcoming Exams -->
                <div class="bg-white rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-3">📘 Upcoming Exams</h2>
                    @forelse ($upcomingExams ?? [] as $exam)
                        <div class="border-b py-2">
                            <p class="text-sm font-medium">{{ $exam->title }} ({{ $exam->subject }})</p>
                            <p class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y H:i') }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No upcoming exams.</p>
                    @endforelse
                </div>

                <!-- Recent Results -->
                <div class="bg-white rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-3">📊 Recent Results</h2>
                    @forelse ($results ?? [] as $result)
                        <div class="border-b py-2 flex justify-between">
                            <span>{{ $result->subject }}</span>
                            <span class="font-semibold text-green-600">{{ $result->marks }}%</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No results available.</p>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>

</html>
