<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
// admin role tables
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }
// -------------------------------------------------- //

// user role tables
    public function exam_attempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }
// -------------------------------------------------- // 

// ==================================================== //
// manu 

    public function manues()
    {
        return $this->hasMany(Manu::class);
    }

}
