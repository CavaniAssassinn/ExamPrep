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
                    <a href="#" class="block px-6 py-2 hover:bg-gray-100">My Tasks</a>
                    <a href="#" class="block px-6 py-2 hover:bg-gray-100">Notifications</a>
                </nav>
            </div>
            <div class="p-6 border-t">
                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-sm text-red-600 hover:underline">Logout</button>
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
                    <a href="/profile" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Profile
                    </a>
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded">+ New Task</button>
                </div>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Calendar -->
                <div class="bg-white rounded-xl p-5 shadow-sm">
                    <h2 class="text-lg font-semibold mb-3">📅 Calendar</h2>
                    <p class="text-sm text-gray-500">March 2022 (Static)</p>
                    <div class="mt-2 text-sm text-gray-600">Use a calendar component here</div>
                </div>

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
