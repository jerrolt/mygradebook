<?php

namespace App\Http\Controllers\Api;

use App\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{

    public function loadByAssignment($id)
    {
        $grades = Grade::with('assignment')->with('student')->where('assignment_id', '=', $id)->get();
        return $grades;
    }

    public function loadByStudent($id)
    {
        $grades = Grade::with('student')->with('assignment')->where('student_id', '=', $id)->get();
        return $grades;
    }

    public function create(Request $request)
    {
        $grade = new Grade;
        $grade->student_id = $request->input('student_id');
        $grade->assignment_id = $request->input('assignment_id');
        $grade->score = $request->input('score');

        if($grade->save()){
            return $grade;
        }
    }

}
