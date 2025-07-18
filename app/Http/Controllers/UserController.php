<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:20'],
            'user_role' => ['required', Rule::in(['student', 'lecturer'])],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);

        auth()->login($user);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            "loginname" => "required",
            "loginpassword" => "required",
        ]);

        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect("/");
        }

        return back()->withErrors(['loginname' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'user_role' => ['required', Rule::in(['student', 'lecturer'])],
            'password' => 'nullable|min:8',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->user_role = $validated['user_role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();
        return redirect('/profile')->with('success', 'Your profile has been updated successfully');
    }
}
