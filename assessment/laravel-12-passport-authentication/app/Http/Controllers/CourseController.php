<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function store(Request $request)
    {
       

        $course = Course::create([
            'course_name' => $request->course_name,
        ]);

        return response()->json([
            'message' => 'course inserted successfully',
            'data' => $course
        ], 201);
    }
}
