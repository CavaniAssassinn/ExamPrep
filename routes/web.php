<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;


Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    return view('dashboard.student', ['posts' => $posts]);
});


Route::post('/register', [UserController::class, 'register']);


//handle exams
Route::middleware(['auth'])->group(function () {
    Route::get('/exams/create', [ExamController::class, 'create']);
    Route::post('/exams', [ExamController::class, 'store']);
});

//Route::get('/', function () {
//   $posts = [];
// if (auth()->check()) {
//   $posts = auth()->user()->usersCoolPosts()->latest()->get();

//   }
//    return view('home', ['posts' => $posts]);
//});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

//blogs
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

Route::middleware('auth')->group(
    function () {
        Route::get('/profile', [UserController::class, 'showProfile'])->middleware('auth');
        
    }
);

//dashboard
Route::get('/dashboard', [DashboardController::class, 'showDashboard']);
Route::get('/exams/upcoming', [DashboardController::class, 'upcomingExams']);
Route::get('/results', [DashboardController::class, 'results']);

Route::get('/profile', function () {
    return view('profile'); // or wherever your profile.blade.php is located
})->name('profile');
