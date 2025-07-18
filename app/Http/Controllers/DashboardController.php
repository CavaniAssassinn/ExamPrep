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
        $user = auth()->user();

        // Guest view (no user logged in)
        if (!$user) {
            $upcomingExams = Exam::where('exam_date', '>', now())->get();
            return view('dashboard.guest', [
                'upcomingExams' => $upcomingExams,
            ]);
        }

        // Lecturer dashboard
        if ($user->user_role === 'lecturer') {
            $examCount = Exam::count();
            $studentCount = \App\Models\User::where('user_role', 'student')->count();

            return view('dashboard.lecturer', [
                'examCount' => $examCount,
                'studentCount' => $studentCount,
            ]);
        }

        // Student dashboard
        $upcomingExams = Exam::where('eligible_roles', 'like', '%student%')
            ->where('exam_date', '>', now())
            ->get();

        $results = Result::where('user_id', $user->id)->get();

        return view('dashboard.student', [
            'upcomingExams' => $upcomingExams,
            'results' => $results,
        ]);
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
