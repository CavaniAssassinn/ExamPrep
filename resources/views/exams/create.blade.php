<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Exam | ExamPrep</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">📘 Create New Exam</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/exams" class="space-y-5">
            @csrf

            <!-- Title -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Title</label>
                <input type="text" name="title" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Subject -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Subject</label>
                <input type="text" name="subject" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Date & Time -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Date & Time</label>
                <input type="datetime-local" name="exam_date" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Eligible Roles -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Eligible Roles</label>
                <select name="eligible_roles[]" multiple required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</p>
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 rounded">
                ➕ Create Exam
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="/" class="inline-block bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                ← Back to Dashboard
            </a>
        </div>
    </div>
</body>

</html>
