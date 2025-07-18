<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\StudentController;

// 🔰 Homepage — Student or Guest Dashboard
Route::get('/', [DashboardController::class, 'showDashboard'])->name('home');

// 🧑‍🎓 Guest Routes (Login / Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login.attempt');
    Route::post('/register', [UserController::class, 'register'])->name('register.attempt');
});

// 🔐 Authenticated Users
Route::middleware('auth')->group(function () {

    // 🔓 Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // 🙍 Profile
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // 📝 Posts
    Route::post('/create-post', [PostController::class, 'createPost'])->name('post.create');
    Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->name('post.edit');
    Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost'])->name('post.update');
    Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name('post.delete');

    // 📘 Student Dashboard
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

    // 👨‍🏫 Lecturer Redirect Dashboard
    Route::get('/lecturer-dashboard', [DashboardController::class, 'showDashboard'])->name('lecturer.dashboard');


    // 📚 Exam Management (Lecturers Only)
    Route::prefix('manage')->middleware('can:create,App\Models\Exam')->group(function () {
        Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');         // Manage Exams Page
        Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create'); // Create Form
        Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');         // Save Exam
        Route::delete('/exams/{id}', [ExamController::class, 'destroy'])->name('exams.destroy');
    });

    // 📊 Results — for Lecturers Only
    Route::middleware('can:create,App\Models\Result')->group(function () {
        Route::get('/results/create', [ResultsController::class, 'create'])->name('results.create');
        Route::post('/results', [ResultsController::class, 'store'])->name('results.store');
    });

    // 👨‍🎓 Manage Students (Lecturer Only)
    Route::prefix('manage')->name('students.')->group(function () {
        Route::get('/students', [StudentController::class, 'index'])->name('index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('create');
        Route::post('/students', [StudentController::class, 'store'])->name('store');
        Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('destroy');
    });
});

// 🔎 Public Exam Access (Guests or Students)
Route::get('/exams/upcoming', [DashboardController::class, 'upcomingExams'])->name('exams.upcoming');
Route::get('/results', [DashboardController::class, 'results'])->name('results');
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');

Route::get('/manage/exams/create', [ExamController::class, 'create'])->name('exams.create');
Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/results/create', [ResultsController::class, 'create'])->name('results.create');
    Route::post('/results', [ResultsController::class, 'store'])->name('results.store');
});

Route::get('/dashboard/upload-results', function () {
    return view('dashboard.upload_results');
})->middleware('auth')->name('results.upload');
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/manage/exams/{exam}/edit', [ExamController::class, 'edit'])
        ->middleware('can:update,exam')
        ->name('exams.edit');

    Route::put('/manage/exams/{exam}', [ExamController::class, 'update'])
        ->middleware('can:update,exam')
        ->name('exams.update');
});
