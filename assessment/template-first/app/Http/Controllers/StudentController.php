<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {

        
    }

    public function register()
    {
       // dd("sdhfgkhhkgjfhdg");
        return view('student.register'); 
    }


        public function store(Request $request)
    {
        // dd("ssxxdscdw");
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact'=> 'required|numeric',
            'course' => 'nullable',
            'address' => 'nullable',
            'age' => 'nullable',
        ]);
        // dd($validatedData);

        Student::create($validatedData);
       // return view('layouts.register');

        // Redirect to the student index page with a success message
        return redirect()->route('student.register')->with('success', 'Student created successfully.');

    }

    public function edit($id)
{
    //dd("sdjkhljkd");
    $student = Student::findOrFail($id);

    // Pass the student data to the view
    return view('student.edit', compact('student'));
}

    public function update(Request $request, $id)
    {
        //dd("ddjsgerygfu");
        // Validate incoming data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:students,email,' . $student->id,
        //     'phone' => 'required|string|max:15',

        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email', 
        //     'contact'=> 'required|numeric',
        //     'course' => 'nullable',
        //     'address' => 'nullable',
        //     'age' => 'nullable',


        // ]);
        $student = Student::find($id);
        $student->update($request->all());

        return view(student.register)->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    public function list()
{
    // Assuming you have a model called 'Item' (adjust if necessary)
    $items = Student::all();

    // Return the list of items as a JSON response (or use a view if needed)
    return view('student.list', compact('items'));
}
}



    

