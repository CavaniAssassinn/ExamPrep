<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8 font-sans">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">📥 Upload Exam Results</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 border border-green-400 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('results.store') }}">
            @csrf

            <!-- Student -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">Student</label>
                <select name="user_id" required class="w-full border border-gray-300 px-4 py-2 rounded">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                    @endforeach
                </select>
            </div>
            <!-- Subject -->
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                <input type="text" name="subject" id="subject" required
                    class="mt-1 block w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Exam -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold text-gray-700">Exam</label>
                <select name="exam_id" required class="w-full border border-gray-300 px-4 py-2 rounded">
                    @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->title }} - {{ $exam->subject }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Mark -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold text-gray-700">Mark</label>
                <input type="number" name="marks" min="0" max="100" required
                    class="w-full border border-gray-300 px-4 py-2 rounded">
            </div>

            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">
                ✅ Submit Result
            </button>
            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-block bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                    ← Back to Dashboard
                </a>
            </div>
        </form>
    </div>
</body>

</html>
