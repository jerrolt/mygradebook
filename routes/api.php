<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('assignments', 'Api\AssignmentController')->only(['index']);
Route::resource('students', 'Api\StudentController')->only(['index']);

Route::get('assignment/{id}', 'Api\AssignmentController@load');
Route::get('student/{id}', 'Api\StudentController@load');
Route::get('grades/assignment/{id}', 'Api\GradeController@loadByAssignment');
Route::get('grades/student/{id}', 'Api\GradeController@loadByStudent');

Route::put('assignment', 'Api\AssignmentController@update');

Route::post('assignment', 'Api\AssignmentController@create');
Route::post('student', 'Api\StudentController@create');
Route::post('grade', 'Api\GradeController@create');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
