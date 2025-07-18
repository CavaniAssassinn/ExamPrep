<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    // It allows mass assignment for these fields
    protected $fillable = ['title', 'subject', 'exam_date', 'eligible_roles'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }


    public function scopeUpcoming($query)
    {
        return $query->where('exam_date', '>', now())->orderBy('exam_date');
    }

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'subject' => $this->faker->word,
            'exam_date' => now()->addDays(rand(1, 30)),
            'eligible_roles' => 'student',
        ];
    }

}
