<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    // 📄 Show the Manage Exams page
    public function index()
    {
        $exams = Exam::all(); // or paginate if needed
        return view('dashboard.manage_exams', compact('exams'));
    }

    // 📋 Show Create Exam form
    public function create()
    {
        return view('exams.create');
    }

    // 💾 Store new exam
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'eligible_roles' => 'required|array',
            'eligible_roles.*' => 'in:student,lecturer',
        ]);

        // Convert eligible_roles array to comma-separated string
        $validated['eligible_roles'] = implode(',', $validated['eligible_roles']);

        Exam::create($validated);

        return redirect()->route('exams.index')->with('success', 'Exam created successfully!');
    }

    // ❌ Delete an exam
    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return back()->with('success', 'Exam deleted successfully.');
    }
}
