<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | ExamPrep</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">🎓 ExamPrep Login</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/login" class="space-y-4">
            @csrf

            <div>
                <label for="loginname" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="loginname" name="loginname"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    placeholder="Enter your username" required>
            </div>

            <div>
                <label for="loginpassword" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="loginpassword" name="loginpassword"
                    class="mt-1 w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    placeholder="Enter your password" required>
                <div class="text-right mt-1">
                    <a href="#" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-medium py-2 px-4 rounded">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Don't have an account? <a href="/register" class="text-yellow-600 hover:underline">Register</a>
        </p>
    </div>
</body>

</html>
