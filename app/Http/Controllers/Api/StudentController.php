<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('lastname', 'ASC')->get();
        return $students;
    }

    public function create(Request $request)
    {
        $student = new Student;
        $student->firstname = $request->input('firstname');
        $student->lastname = $request->input('lastname');
        $student->birthday = $request->input('birthday');

        if($student->save()){
            return $student;
        }
    }

    public function load($id)
    {
        $student = Student::select("*")->where('id', '=', $id)->get();
        return $student;
    }
}
