<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['title', 'subject', 'exam_date', 'eligible_roles'];

    /**
     * A single exam can have many results (e.g. per student)
     */
    public function results()
    {
        return $this->hasMany(Result::class);
    }

    /**
     * Scope: get only upcoming exams (exam_date in the future)
     */
    public function scopeUpcoming($query)
    {
        return $query->where('exam_date', '>', now())->orderBy('exam_date');
    }
}
