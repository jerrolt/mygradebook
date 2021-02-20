<?php

namespace App\Http\Controllers\Api;

use App\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    
    public function index()
    {
        $assignments = Assignment::orderBy('date_due', 'DESC')->orderBy('name', 'ASC')->get();
        return $assignments;
    }

    public function load($id)
    {
        $assignment = Assignment::select("*")->where('id', '=', $id)->get();
        return $assignment;
    }

    public function update(Request $request)
    {
        $assignment = Assignment::select("*")->where('id', '=', $request->input('id'))->get();
        return $assignment;
    }
    public function create(Request $request)
    {
        $assignment = new Assignment;
        $assignment->name = $request->input('name');
        $assignment->date_due = $request->input('date_due');

        if($assignment->save()){
            return $assignment;
        }
    }
}
