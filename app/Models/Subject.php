<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['code', 'name', 'description', 'department', 'credits'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}