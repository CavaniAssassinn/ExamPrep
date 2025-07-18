<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen font-sans py-10">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-green-500 text-white text-center py-4">
            <h1 class="text-2xl font-bold">📊 Your Results</h1>
        </div>

        <div class="overflow-x-auto p-6">
            <table class="min-w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Subject</th>
                        <th class="px-6 py-3 text-left font-semibold">Marks</th>
                        <th class="px-6 py-3 text-left font-semibold">Performance</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-800">
                    @forelse ($results as $result)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $result->subject }}</td>
                            <td class="px-6 py-4 font-semibold text-green-600">{{ $result->marks }}%</td>
                            <td class="px-6 py-4">
                                @if ($result->marks >= 75)
                                    <span
                                        class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">Excellent</span>
                                @elseif ($result->marks >= 50)
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full">Pass</span>
                                @elseif ($result->marks >= 40)
                                    <span
                                        class="bg-orange-100 text-orange-800 text-sm font-medium px-3 py-1 rounded-full">Borderline</span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full">Fail</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-6 text-gray-500">No results available.</td>
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
