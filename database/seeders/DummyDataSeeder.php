<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Exam;
use App\Models\Result;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create 4 lecturers
        User::factory()->count(4)->create([
            'user_role' => 'lecturer',
            'password' => Hash::make('password123'),
        ]);

        // Create 20 students
        $students = User::factory()->count(20)->create([
            'user_role' => 'student',
            'password' => Hash::make('password123'),
        ]);

        // Create 5 exams with full required data
        $exams = collect();
        foreach (range(1, 5) as $i) {
            $exams->push(Exam::create([
                'title' => "Exam $i",
                'subject' => "Subject $i",
                'exam_date' => Carbon::now()->addDays($i * 3),
                'eligible_roles' => 'student,lecturer',
            ]));
        }

        // Assign random results to students
        foreach ($students as $student) {
            foreach ($exams->random(3) as $exam) {
                Result::create([
                    'user_id' => $student->id,
                    'exam_id' => $exam->id,
                    'subject' => $exam->subject,
                    'marks' => rand(40, 100),
                ]);
            }
        }
    }
}
