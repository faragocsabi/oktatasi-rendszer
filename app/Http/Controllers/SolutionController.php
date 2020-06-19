<?php

namespace App\Http\Controllers;

use App\Solution;
use App\Task;
use App\Subject;
use App\User;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectFormRequest;
use App\Http\Requests\SolutionCheckFormRequest;
use App\Http\Requests\SolutionFormRequest;
use App\Http\Requests\TaskFormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SolutionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        $id = $task['subject_id'];
        $subject = Subject::find($id);
        $teacher = Teacher::find($subject['teacher_id']);
        $datalist = [
            'Tárgy neve' => $subject['name'],
            'Tanár neve' => $teacher['name'],
            'Feladat leírása' => $task['description'],
            'Pontszám' => $task['points'],
            'Elérhető' => $task['start_date'],
            'Határidő' => $task['end_date']
        ];
        return view('student.createSolution', [
            'id' => $task['id'],
            'datalist' => $datalist
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task, SolutionFormRequest $request)
    {
        // Validate
        $data = $request->validated();

        // Store the file uploaded, and create a solution
        $filename = '';
        if($data['file']) {
            $filename = time().'.'.$request->file->extension();
            $request->file->move(public_path('storage/files'), $filename);
            $data['filename'] = $filename;
        }

        $data['task_id'] = $task['id'];
        $data['student_id'] = Auth::user()->student->id;
        $data['uploaded_at'] = Carbon::now();
        $task->solutions()->create($data);

        return redirect()->route('task.show', ['task' => $task['id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function show(Solution $solution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function edit(Solution $solution)
    {
        $task = Task::find($solution['task_id']);
        return view('teacher.editSolution', [
            'solution' => $solution,
            'task' => $task,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(SolutionCheckFormRequest $request, Solution $solution)
    {
        // Making the changes
        $data = $request->validated();
        $data['checked'] = true;
        $data['checked_at'] = Carbon::now();
        $solution->update($data);
        $task = Task::find($solution['task_id']);

        return redirect()->route('task.show', ['task' => $task['id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solution $solution)
    {
        //
    }

    /**
     * Download the specific file from storage.
     */
    public function downloadFile($filename){
        return response()->download(public_path('storage/files/'.$filename));
    }
}
