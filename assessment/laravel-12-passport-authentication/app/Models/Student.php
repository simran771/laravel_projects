<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\StudentController;

class Student extends Model
{

    protected $fillable = ['name'];

    use HasFactory;

    // Define the many-to-many relationship with Course
    public function courses()
    {
        return $this->belongsToMany(Course::class); // A Student can have many Courses
    }
}
