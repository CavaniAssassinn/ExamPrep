<?php


use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->middleware(['auth', 'can:admin'])->group(function () {
    // Exam Management
    Route::resource('exams', ExamController::class);
    
    // Exam Questions Management (nested under exams)
    Route::prefix('exams/{exam}')->group(function () {
        Route::get('questions', [QuestionController::class, 'index'])->name('exams.questions.index');
        Route::get('questions/create', [QuestionController::class, 'create'])->name('exams.questions.create');
        Route::post('questions', [QuestionController::class, 'store'])->name('exams.questions.store');
        Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->name('exams.questions.edit');
        Route::put('questions/{question}', [QuestionController::class, 'update'])->name('exams.questions.update');
        Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->name('exams.questions.destroy');
    });

    // User Management
    Route::resource('users', UserController::class)->except(['show']);
});