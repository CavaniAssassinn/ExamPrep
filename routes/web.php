<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ResultsController;
<<<<<<< Updated upstream
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
=======

// 🔰 Homepage (Student Dashboard)
Route::get('/', [DashboardController::class, 'showDashboard'])->name('home');

// 🔒 Guest-only routes (Login & Register Pages)
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
});

// 🔐 Authenticated-only routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // Blog Posts
    Route::post('/create-post', [PostController::class, 'createPost'])->name('post.create');
    Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->name('post.edit');
    Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost'])->name('post.update');
    Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name('post.delete');

    // Exams (Lecturers only, optional middleware for role could go here)
    Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');

    Route::get('/results/create', [ResultsController::class, 'create'])->middleware('auth');
    Route::post('/results', [ResultsController::class, 'store'])->middleware('auth');
>>>>>>> Stashed changes

    // 🙍 Profile
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

<<<<<<< Updated upstream
    // 📝 Posts
    Route::post('/create-post', [PostController::class, 'createPost'])->name('post.create');
    Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->name('post.edit');
    Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost'])->name('post.update');
    Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name('post.delete');

    // 🎓 Exams — for Lecturers Only
    Route::middleware('can:create,App\Models\Exam')->group(function () {
        Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
        Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');
    });

    // 📊 Results — for Lecturers Only
    Route::middleware('can:create,App\Models\Result')->group(function () {
        Route::get('/results/create', [ResultsController::class, 'create'])->name('results.create');
        Route::post('/results', [ResultsController::class, 'store'])->name('results.store');
    });

    // 👨‍🎓 Manage Students (Lecturer Only)
    Route::prefix('manage')->name('students.')->group(function () {
        Route::get('/students', [StudentController::class, 'index'])->name('index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('create'); // 👈 Add form to create student
        Route::post('/students', [StudentController::class, 'store'])->name('store');         // 👈 Handle creation
        Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('destroy');
    });
});

// 🧑‍🏫 Lecturer Redirect Dashboard
Route::get('/lecturer-dashboard', function () {
    return view('dashboard.lecturer');
})->middleware('auth')->name('lecturer.dashboard');

// 📘 Student Dashboard
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware('auth')->name('dashboard');

// 🔎 Public Exam Access (Guests or Students)
Route::get('/exams/upcoming', [DashboardController::class, 'upcomingExams'])->name('exams.upcoming');
Route::get('/results', [DashboardController::class, 'results'])->name('results');
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');

// 🔒 Authenticated Exam Management
Route::middleware('auth')->group(function () {
    Route::get('/manage/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::delete('/exams/{id}', [ExamController::class, 'destroy'])->name('exams.destroy');
});

=======
});

// 🛡️ Auth handling
Route::post('/login', [UserController::class, 'login'])->name('login.attempt');
Route::post('/register', [UserController::class, 'register'])->name('register.attempt');

// 📊 Dashboard & Exam Access (for students)
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::get('/exams/upcoming', [DashboardController::class, 'upcomingExams'])->name('exams.upcoming');
Route::get('/results', [DashboardController::class, 'results'])->name('results');
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');
Route::get(
    '/create-post',
    function () {
        return view('/exams/create');
    }
)->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/exams/create', [ExamController::class, 'create'])->middleware('can:create,App\Models\Exam');
    Route::post('/exams', [ExamController::class, 'store'])->middleware('can:create,App\Models\Exam');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
});
>>>>>>> Stashed changes
