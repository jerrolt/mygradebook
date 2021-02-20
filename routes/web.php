<?php

use Carbon\Carbon;

use App\Http\Controllers\AssignmentController;
use App\Student;
use App\Assignment;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/assignments', function () {
    return view('assignment.index');
});
// Route::get('/assignment-students', function () {
//     return view('assignment.students');
// });

Route::get('/assignment/{id}', function ($id) {
    //$today = Carbon::now()->format('Y-m-d');
    $assignment = Assignment::where('id','=',$id)->get();
    //return view('article.home', ['today' => $today,'articles'=>$articles]);
    //$assignment[0]->id
    return view('assignment.students',['assignmentId'=>$id]);
});


Route::get('/students', function () {
    return view('student.index');
});

Route::get('/student/{id}', function ($id) {
    //$today = Carbon::now()->format('Y-m-d');
    $student = Student::where('id','=',$id)->get();
    //return view('article.home', ['today' => $today,'articles'=>$articles]);
    //$student[0]->id
    return view('student.assignments',['studentId'=>$id]);
});
