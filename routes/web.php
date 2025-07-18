<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\ResultsController;
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream
        Route::get('/profile', [UserController::class, 'showProfile'])->middleware('auth');
        
=======
        return view('/exams/create');
>>>>>>> Stashed changes
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
