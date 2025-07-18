<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upcoming Exams</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans min-h-screen py-10">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-yellow-400 text-white text-center py-5">
            <h1 class="text-3xl font-bold">📘 Upcoming Exams</h1>
        </div>

        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Title</th>
                        <th class="px-6 py-3 text-left font-semibold">Subject</th>
                        <th class="px-6 py-3 text-left font-semibold">Date / Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($exams as $exam)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $exam->title }}</td>
                            <td class="px-6 py-4">{{ $exam->subject }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-500">No upcoming exams available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center mt-6">
        <a href="/dashboard" class="inline-block bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition">
            ← Back to Dashboard
        </a>
    </div>
</body>

</html>
