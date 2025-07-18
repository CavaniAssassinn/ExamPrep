<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function create()
    {
        if (auth()->user()->user_role !== 'lecturer') {
            abort(403, 'Unauthorized');
        }

        if (auth()->user()->user_role !== 'lecturer') {
            abort(403, 'Unauthorized');
        }

        return view('exams.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->user_role !== 'lecturer') {
            abort(403, 'Unauthorized');
        }

        if (auth()->user()->user_role !== 'lecturer') {
            abort(403, 'Unauthorized');
        }

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
