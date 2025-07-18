<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="max-w-3xl mx-auto mt-10 bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">👤 Profile Settings</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="/profile" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block mb-1 font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-blue-200 focus:outline-none">
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-blue-200 focus:outline-none">
            </div>

            {{-- Password --}}
            <div>
                <label class="block mb-1 font-medium text-gray-700">New Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-blue-200 focus:outline-none">
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block mb-1 font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-blue-200 focus:outline-none">
            </div>

            {{-- Profile Photo --}}
            <div>
                <label class="block mb-1 font-medium text-gray-700">Profile Picture</label>
                <div class="mb-2">
                    <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/default-avatar.png') }}"
                        alt="Profile Picture" class="w-20 h-20 rounded-full border border-gray-300">
                </div>
                <input type="file" name="profile_photo"
                    class="w-full border border-gray-300 rounded px-4 py-2 file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-yellow-400 file:text-white hover:file:bg-yellow-500">
                @error('profile_photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 rounded">
                Update Profile
            </button>
        </form>
        <p class="text-center mt-6">
            <a href="/" class="inline-block bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                ← Back to Dashboard
            </a>
        </p>

    </div>
</body>

</html>
