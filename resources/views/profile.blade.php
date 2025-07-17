<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
    <h1>Profile Page</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/profile" method="POST">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required><br>

        <label>New Password:</label>
        <input type="password" name="password"><br>

        <label>Confirm New Password:</label>
        <input type="password" name="password_confirmation"><br>

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
