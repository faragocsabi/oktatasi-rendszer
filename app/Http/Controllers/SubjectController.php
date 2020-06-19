<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectFormRequest;
use App\Subject;
use App\Task;
use App\Solution;
use App\User;
use App\Teacher;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubjectController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->is_teacher === '1')
        {
            $subjects = Auth::user()->teacher->subjects;
            return view('teacher.list', ['subjects' => $subjects]);
        }
        else
        {
            $subjects = Auth::user()->student->subjects;
            return view('student.list', ['subjects' => $subjects]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.createSubject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectFormRequest $request)
    {
        $data = $request->validated();
        $data['teacher_id'] = Auth::user()->teacher->id;
        Subject::create($data);
        return redirect()->route('teacher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        // Filter the subject for the required attributes
        $filtered_subject = [
            'id' => $subject['id'],
            'Név' => $subject['name'],
            'teacher_id' => $subject['teacher_id'],
            'Leírás' => $subject['description'],
            'Kód' => $subject['code'],
            'Kredit' => $subject['credit'],
            'Publikus?' => $subject['public'] ? 'Igen' : 'Nem',
            'Létrehozva' => $subject['created_at'],
            'Utolsó módosítás' => $subject['updated_at']
        ];
        // Get the Students
        $students = $subject->students->toArray();

        // Get the Tasks
        $tasks = Task::where('subject_id', '=', $subject['id'])->orderBy('end_date', 'DESC')->get();

        // Get the teacher
        $searchid = $subject['teacher_id'];
        $teacher = Teacher::find($searchid);

        // Current Time
        $mytime = Carbon::now();

        if(Auth::user()->is_teacher === '1')
        {
            $this->authorize('access', $subject);
            return view('teacher.showSubject', [
                'subject' => $filtered_subject, 
                'teacher' => $teacher, 
                'students' => $students, 
                'tasks' => $tasks,
                'mytime' => $mytime
            ]);
        }
        else
        {
            return view('student.showSubject', [
                'subject' => $filtered_subject,
                'teacher' => $teacher,
                'students' => $students,
                'tasks' => $tasks,
                'mytime' => $mytime
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $this->authorize('access', $subject);
        return view('teacher.editSubject', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectFormRequest $request, Subject $subject)
    {
        $this->authorize('access', $subject);
        $subject->update($request->validated());

        return redirect()->route('subject.show', ['subject' => $subject['id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('access', $subject); 
        $subject->delete();
        return redirect()->route('teacher.index');
    }

    public function togglePublic($id)
    {
        $current = DB::table('subjects')->where('id', $id)->first();
        if($current->public === '1')
        {
            DB::table('subjects')
            ->where('id', $id)
            ->update(['public' => '0']);
        }
        else
        {
            DB::table('subjects')
            ->where('id', $id)
            ->update(['public' => '1']);
        }

        return redirect()->route('main');
    }
}
