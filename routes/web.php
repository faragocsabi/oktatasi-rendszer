<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', function() { return view('about'); })->name('about');

Route::middleware(['auth'])->group(function () {
    Route::get('/main', 'HomeController@insideMain')->name('main'); // bejelentkezes utan at kell hogy dobjon egy oldalra, ez kezeli le azt

    Route::get('/profile', function(){ return view('profile'); })->name('profile');
    
    // Subject
    Route::resource('subject', 'SubjectController');

    // Task
    Route::resource('subject.task', 'TaskController')->shallow()->except(['index']);
    Route::get('/tasks', 'TaskController@index')->name('tasks');

    // Solution
    Route::resource('task.solution', 'SolutionController')->shallow()->except(['index']);
    Route::get( '/download/{filename}', 'SolutionController@downloadFile')->name('downloadFile');
    
    // Teacher
    Route::resource('teacher', 'TeacherController');
    Route::post('/publish/{id}', 'SubjectController@togglePublic')->name('subject.togglePublic');

    // Student
    Route::resource('student', 'StudentController');
    Route::get('/available', 'StudentController@availableSubjects')->name('available');
    Route::post('/apply/{id}', 'StudentController@apply')->name('apply');
    Route::post('/remove/{id}', 'StudentController@remove')->name('remove');

});

Auth::routes();
