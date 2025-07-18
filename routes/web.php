<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AKNPostController;
use App\Http\Controllers\AKNUserController;
use App\Http\Controllers\AKNDashboardController;
use App\Http\Controllers\AKNExamController;
use App\Http\Controllers\AKNResultsController;
use App\Http\Controllers\AKNStudentController;

// 🔰 Homepage — Student or Guest Dashboard
Route::get('/', [AKNDashboardController::class, 'showDashboard'])->name('home');

// 🧑‍🎓 Guest Routes (Login / Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AKNUserController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AKNUserController::class, 'showRegisterForm'])->name('register');
    Route::post('/login', [AKNUserController::class, 'login'])->name('login.attempt');
    Route::post('/register', [AKNUserController::class, 'register'])->name('register.attempt');
});

// 🔐 Authenticated Users
Route::middleware('auth')->group(function () {

    // 🔓 Logout
    Route::post('/logout', [AKNUserController::class, 'logout'])->name('logout');

    // 🙍 Profile
    Route::get('/profile', [AKNUserController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AKNUserController::class, 'updateProfile'])->name('profile.update');

    // 📝 Posts
    Route::post('/create-post', [AKNPostController::class, 'createPost'])->name('post.create');
    Route::get('/edit-post/{post}', [AKNPostController::class, 'showEditScreen'])->name('post.edit');
    Route::put('/edit-post/{post}', [AKNPostController::class, 'actuallyUpdatePost'])->name('post.update');
    Route::delete('/delete-post/{post}', [AKNPostController::class, 'deletePost'])->name('post.delete');

    // 📘 Student Dashboard
    Route::get('/dashboard', [AKNDashboardController::class, 'showDashboard'])->name('dashboard');

    // 👨‍🏫 Lecturer Redirect Dashboard
    Route::get('/lecturer-dashboard', [AKNDashboardController::class, 'showDashboard'])->name('lecturer.dashboard');

    // 📚 Exam Management (Lecturers Only)
    Route::prefix('manage')->middleware('can:create,App\Models\Exam')->group(function () {
        Route::get('/exams', [AKNExamController::class, 'index'])->name('exams.index');
        Route::get('/exams/create', [AKNExamController::class, 'create'])->name('exams.create');
        Route::post('/exams', [AKNExamController::class, 'store'])->name('exams.store');
        Route::delete('/exams/{id}', [AKNExamController::class, 'destroy'])->name('exams.destroy');
    });

    // 📊 Results — for Lecturers Only
    Route::middleware('can:create,App\Models\Result')->group(function () {
        Route::get('/results/create', [AKNResultsController::class, 'create'])->name('results.create');
        Route::post('/results', [AKNResultsController::class, 'store'])->name('results.store');
    });

    // 👨‍🎓 Manage Students (Lecturer Only)
    Route::prefix('manage')->name('students.')->group(function () {
        Route::get('/students', [AKNStudentController::class, 'index'])->name('index');
        Route::get('/students/create', [AKNStudentController::class, 'create'])->name('create');
        Route::post('/students', [AKNStudentController::class, 'store'])->name('store');
        Route::delete('/students/{id}', [AKNStudentController::class, 'destroy'])->name('destroy');
    });
});

// 🔎 Public Exam Access (Guests or Students)
Route::get('/exams/upcoming', [AKNDashboardController::class, 'upcomingExams'])->name('exams.upcoming');
Route::get('/results', [AKNDashboardController::class, 'results'])->name('results');
Route::get('/exams/{exam}', [AKNExamController::class, 'show'])->name('exams.show');

Route::get('/manage/exams/create', [AKNExamController::class, 'create'])->name('exams.create');
Route::post('/exams', [AKNExamController::class, 'store'])->name('exams.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/results/create', [AKNResultsController::class, 'create'])->name('results.create');
    Route::post('/results', [AKNResultsController::class, 'store'])->name('results.store');
});

Route::get('/dashboard/upload-results', function () {
    return view('dashboard.upload_results');
})->middleware('auth')->name('results.upload');
Route::get('/dashboard', [AKNDashboardController::class, 'showDashboard'])->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/manage/exams/{exam}/edit', [AKNExamController::class, 'edit'])
        ->middleware('can:update,exam')
        ->name('exams.edit');

    Route::put('/manage/exams/{exam}', [AKNExamController::class, 'update'])
        ->middleware('can:update,exam')
        ->name('exams.update');
});
