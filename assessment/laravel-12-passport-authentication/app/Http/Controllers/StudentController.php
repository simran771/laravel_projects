<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request)
    {
       

        $student = Student::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'student inserted successfully',
            'data' => $student
        ], 201);
    }
}
