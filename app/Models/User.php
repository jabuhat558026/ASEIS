<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
 
    protected $fillable = [
        'name', 'email', 'password', 'role',
        'student_id', 'major', 'enrollment_date',
    ];
 
    protected $hidden = ['password', 'remember_token'];
 
    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }
 
    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isStudent(): bool  { return $this->role === 'student'; }
 
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
 
    public function activeEnrollments()
    {
        return $this->hasMany(Enrollment::class)->where('status', 'active');
    }
}