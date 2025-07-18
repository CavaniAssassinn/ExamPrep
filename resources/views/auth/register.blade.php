<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">🎓 Create Your Account</h2>
            <a href="/dashboard" class="text-sm text-blue-600 hover:underline bg-gray-100 px-3 py-1 rounded shadow-sm">
                ← Dashboard
            </a>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-600 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your name"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300">
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" placeholder="you@example.com"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300">
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="Choose a password"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300">
            </div>

            {{-- User Role --}}
            <div>
                <label for="user_role" class="block font-medium text-gray-700 mb-1">Role</label>
                <select name="user_role" id="user_role"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300">
                    <option value="student">Student</option>
                    <option value="lecturer">Lecturer</option>
                </select>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 rounded transition duration-200">
                Register
            </button>
        </form>

        <div class="text-center mt-6 space-y-2">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="/login" class="text-blue-600 hover:underline">Login here</a>
            </p>
            <a href="/dashboard"
                class="inline-block mt-2 text-sm text-gray-700 bg-gray-200 hover:bg-gray-300 px-4 py-1 rounded">
                ← Back to Dashboard
            </a>
        </div>
    </div>
</body>

</html>
