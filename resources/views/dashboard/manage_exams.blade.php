<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Exams</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen font-sans p-8">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">📚 Manage Exams</h1>
            <div class="flex gap-2">
                <a href="{{ route('exams.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    + Add Exam
                </a>


                <a href="/dashboard" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                    ← Back to Dashboard
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 text-green-700 border border-green-300 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Subject</th>
                    <th class="py-2 px-4 border-b">Exam Date</th>
                    <th class="py-2 px-4 border-b">Eligible Roles</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exams as $exam)
                    <tr class="text-gray-800">
                        <td class="py-2 px-4 border-b">{{ $exam->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $exam->subject }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y H:i') }}</td>
                        <td class="py-2 px-4 border-b">{{ $exam->eligible_roles }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('exams.destroy', $exam->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this exam?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">No exams found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
