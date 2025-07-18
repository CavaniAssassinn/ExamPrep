<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lecturer Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen font-sans p-8">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">🎓 Lecturer Dashboard</h1>
            <form action="/logout" method="POST">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div class="bg-blue-100 p-4 rounded">
                <p class="text-sm text-gray-600">Total Students</p>
                <p class="text-2xl font-semibold text-blue-800">{{ $studentCount }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded">
                <p class="text-sm text-gray-600">Total Exams</p>
                <p class="text-2xl font-semibold text-green-800">{{ $examCount }}</p>
            </div>
        </div>

        <div class="flex flex-wrap gap-4">
            <a href="{{ route('students.index') }}" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">
                👥 Manage Students
            </a>

            <a href="/manage/exams" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">
                📚 Manage Exams
            </a>

            <a href="/results/create" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded">
                📥 Upload Result
            </a>
        </div>
    </div>
</body>

</html>
