<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Result;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $user = Auth::user();

        if ($user->role === 'lecturer') {
            // Lecturer dashboard
            $examCount = Exam::count();
            $studentCount = \App\Models\User::where('role', 'student')->count();

            return view('dashboard.lecturer', [
                'examCount' => $examCount,
                'studentCount' => $studentCount
            ]);
        } else {
            // Student dashboard with null-safe fallbacks
            $upcomingExams = Exam::where('eligible_roles', 'like', '%student%')
                ->where('exam_date', '>', now())
                ->get() ?? collect();

            $results = Result::where('user_id', $user?->id)->get() ?? collect();

            return view('dashboard.student', [
                'upcomingExams' => $upcomingExams,
                'results' => $results
            ]);
        }
    }

    public function upcomingExams()
    {
        $user = Auth::user();

        $exams = Exam::where('eligible_roles', 'like', "%{$user->role}%")
            ->where('exam_date', '>', now())
            ->get();

        return view('exams.upcoming', ['exams' => $exams]);
    }

    public function results()
    {
        $results = Result::where('user_id', Auth::id())->get();
        return view('results.index', ['results' => $results]);
    }
}
