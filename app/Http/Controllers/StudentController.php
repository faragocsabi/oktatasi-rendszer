<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use App\Http\Requests\SubjectFormRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Auth::user()->student->subjects;
        return view('student.list', ['subjects' => $subjects]);
    }


    /*
     * Display a listing of the public subjects..
     *
     */
    public function availableSubjects()
    {
        $subjects = Subject::all();
        return view('student.apply', ['subjects' => $subjects]);
    }

    /*
     * Attach student and subject
     *
     */
    public function apply($id)
    {
        $user = Auth::user();
        $user->student->subjects()->attach($id);
        return redirect()->route('student.index');
    }

    /*
     * Detach student and subject
     *
     */
    public function remove($id)
    {
        $user = Auth::user();
        $user->student->subjects()->detach($id);
        return redirect()->route('student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {

    }
}
