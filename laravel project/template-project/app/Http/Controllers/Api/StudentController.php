<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $limit_num, $page_num)
    {

        dd($request->limit_num, $request->page_num);
        $limit = $request->limit_num ?? 5;
        $page = $request->page_num ?? 1;
        $offset = ($page-1)*$limit;


        $student_list = Student::query();
        $students = $student_list->limit($limit)->offset($offset)->get();


        // dd(count($students));

        $students = Student::all();
        return response()->json($students, 200);
    }

    public function getAllStudents(Request $request)
    {

        // dd($request->limit_num, $request->page_num);
        $limit = $request->limit_num ?? 5;
        $page = $request->page_num ?? 1;
        $offset = ($page-1)*$limit;


        $student_list = Student::query();
        $students = $student_list->limit($limit)->offset($offset)->get();


        // dd(count($students));

        // $students = Student::all();
        return response()->json($students, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $student =  Student::create($request->all());
       return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
