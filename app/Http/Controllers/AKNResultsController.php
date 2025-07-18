<?php

namespace App\Http\Controllers;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class AKNResultsController extends Controller
{
    public function create()
    {
        $students = User::where('user_role', 'student')->get();
        $exams = \App\Models\Exam::all();

        return view('dashboard.upload_results', compact('students', 'exams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'exam_id' => 'required|exists:exams,id',
            'subject' => 'required|string|max:255',
            'marks' => 'required|numeric|min:0|max:100',
        ]);

        Result::create($validated);

        return redirect()->back()->with('success', 'Result uploaded successfully!');
    }



}
