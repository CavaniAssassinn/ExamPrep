<?php

use App\Http\Controllers\Admin\AKNExamController;
use App\Http\Controllers\Admin\AKNQuestionController;
use App\Http\Controllers\Admin\AKNUserController;

Route::prefix('admin')->middleware(['auth', 'can:admin'])->group(function () {
    // Exam Management
    Route::resource('exams', AKNExamController::class);

    // Exam Questions Management (nested under exams)
    Route::prefix('exams/{exam}')->group(function () {
        Route::get('questions', [AKNQuestionController::class, 'index'])->name('exams.questions.index');
        Route::get('questions/create', [AKNQuestionController::class, 'create'])->name('exams.questions.create');
        Route::post('questions', [AKNQuestionController::class, 'store'])->name('exams.questions.store');
        Route::get('questions/{question}/edit', [AKNQuestionController::class, 'edit'])->name('exams.questions.edit');
        Route::put('questions/{question}', [AKNQuestionController::class, 'update'])->name('exams.questions.update');
        Route::delete('questions/{question}', [AKNQuestionController::class, 'destroy'])->name('exams.questions.destroy');
    });

    // User Management
    Route::resource('users', AKNUserController::class)->except(['show']);
});
