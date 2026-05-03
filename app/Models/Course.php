<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['code', 'name', 'instructor', 'schedule', 'credits', 'max_students', 'subject_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function activeEnrollments()
    {
        return $this->hasMany(Enrollment::class)->where('status', 'active');
    }

    public function getEnrolledCountAttribute(): int
    {
        return $this->activeEnrollments()->count();
    }

    public function getSlotsAvailableAttribute(): int
    {
        return $this->max_students - $this->enrolled_count;
    }
}