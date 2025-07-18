<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function create()
    {
        return view('exams.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'subject' => 'required',
            'exam_date' => 'required|date',
            'eligible_roles' => 'required|array',
        ]);

        $data['eligible_roles'] = implode(',', $data['eligible_roles']);
        Exam::create($data);

        return redirect('/dashboard')->with('success', 'Exam was created.');
    }
}
