<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class AKNQuestionController extends Controller
{
    public function create(Exam $exam)
    {
        return view('admin.questions.create', compact('exam'));
    }

    public function store(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_answer' => 'required|integer|min:0|max:' . (count($request->options) - 1),
        ]);

        $question = $exam->questions()->create([
            'question_text' => $validated['question_text'],
            'options' => $validated['options'],
            'correct_answer' => $validated['correct_answer'],
        ]);

        return redirect()->route('exams.show', $exam)->with('success', 'Question added successfully.');
    }

    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_answer' => 'required|integer|min:0|max:' . (count($request->options) - 1),
        ]);

        $question->update($validated);

        return redirect()->route('exams.show', $question->exam)->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $exam = $question->exam;
        $question->delete();
        return redirect()->route('exams.show', $exam)->with('success', 'Question deleted successfully.');
    }
}
