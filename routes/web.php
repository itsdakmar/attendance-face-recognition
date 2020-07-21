<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/resume', function () {
    return view('resume.index');
})->name('resume');

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::post('subject/enroll', 'SubjectController@enroll')->name('subject.enroll');
    Route::resource('subject', 'SubjectController');
    Route::get('attendance', ['as' => 'attendance.index', 'uses' => 'AttendanceController@index']);
    Route::get('attendance/{classId}/live', ['as' => 'attendance.live', 'uses' => 'AttendanceController@live']);
    Route::post('attendance/is-attend', ['as' => 'attendance.isAttend', 'uses' => 'AttendanceController@isAttend']);
    Route::get('attendance/create', ['as' => 'attendance.create', 'uses' => 'AttendanceController@create']);
    Route::post('attendance/store', ['as' => 'attendance.store', 'uses' => 'AttendanceController@store']);
    Route::get('attendance/{classId}/show', ['as' => 'attendance.show', 'uses' => 'AttendanceController@show']);
    Route::post('attendance/student', ['as' => 'attendance.student', 'uses' => 'AttendanceController@store']);
    Route::get('subject/{subjectId}/student', ['as' => 'attendance.student', 'uses' => 'AttendanceController@getStudent']);
    Route::get('student/{studentId}/image', ['as' => 'student.images', 'uses' => 'StudentController@getImage']);
    Route::get('student/profile', ['as' => 'student.profile', 'uses' => 'StudentController@profile']);
    Route::post('student/profile', ['as' => 'student.store', 'uses' => 'StudentController@store']);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

