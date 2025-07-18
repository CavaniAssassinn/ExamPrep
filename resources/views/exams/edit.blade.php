<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Exam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">✏️ Edit Exam</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('exams.update', $exam->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $exam->title) }}" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Subject -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Subject</label>
                <input type="text" name="subject" value="{{ old('subject', $exam->subject) }}" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <!-- Date & Time -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Date & Time</label>
                <input type="datetime-local" name="exam_date"
                    value="{{ old('exam_date', \Carbon\Carbon::parse($exam->exam_date)->format('Y-m-d\TH:i')) }}"
                    required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 rounded">
                💾 Update Exam
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('exams.index') }}"
                class="inline-block bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                ← Back to Manage Exams
            </a>
        </div>
    </div>
</body>

</html>
