<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10 font-sans">
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">📤 Upload Result</h2>

        <form method="POST" action="/results">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">Student</label>
                <select name="user_id" class="w-full border rounded px-3 py-2">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Subject</label>
                <input type="text" name="subject" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Marks (%)</label>
                <input type="number" name="marks" min="0" max="100" required
                    class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 rounded">
                Submit
            </button>
        </form>
    </div>
</body>

</html>
