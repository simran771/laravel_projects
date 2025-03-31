<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CourseController;

class Course extends Model
{
    protected $fillable = ['course_name'];

    use HasFactory;

    // Define the many-to-many relationship with Student
    public function students()
    {
        return $this->belongsToMany(Student::class); // A Course can have many Students
    }
}
