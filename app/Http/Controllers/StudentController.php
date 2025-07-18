<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // Show all students
    public function index()
    {
        $students = User::where('user_role', 'student')->get();
        return view('dashboard.manage_students', compact('students'));
    }

    // Delete a student
    public function destroy($id)
    {
        $student = User::where('user_role', 'student')->findOrFail($id);

        // Delete related posts first using the custom relationship
        $student->usersCoolPosts()->delete();

        // Then delete the student
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully.');
    }


}
