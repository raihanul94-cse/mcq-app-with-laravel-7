<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guarded = [];

    protected $casts = [
        'questions' => 'array'
    ];
// admin role table
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

// user role table
    public function exam_attempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }
}
