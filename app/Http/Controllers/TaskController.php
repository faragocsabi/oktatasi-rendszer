<?php

namespace App\Http\Controllers;

use App\Task;
use App\Subject;
use App\User;
use App\Teacher;
use App\Solution;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectFormRequest;
use App\Http\Requests\TaskFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskController extends Controller
{
        /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('student.listTasks', [
            'subjects' => $subjects,
            'mytime' => Carbon::now()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subject $subject)
    {
        return view('teacher.createTask', [
            'id' => $subject['id']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Subject $subject, TaskFormRequest $request)
    {
        $data = $request->validated();
        $data['subject_id'] = $subject['id'];
        $subject->tasks()->create($data);

        return redirect()->route('subject.show', ['subject' => $subject['id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $solution_count = Solution::where('task_id', '=', $task['id'])->count();
        $checked_solution_count = Solution::where([
            ['task_id', '=', $task['id']],
            ['checked', '=', '1']
        ])->count();
        $solutions = Solution::where([
            ['task_id', '=', $task['id']]
        ])->get();
        $filtered_task = [
            'id' => $task['id'],
            'Név' => $task['name'],
            'Leírás' => $task['description'],
            'Pont' => $task['points'],
            'Elérhető' => $task['start_date'],
            'Határidő' => $task['end_date'],
            'Beadott megoldások száma' => $solution_count,
            'Értékelt megoldások száma' => $checked_solution_count
        ];

        if(Auth::user()->is_teacher === '1')
        {
            return view('teacher.showTask', [
                'task' => $filtered_task,
                'solutions' => $solutions
            ]);
        }
        else
        {
            return view('student.showTask', [
                'task' => $filtered_task
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('teacher.editTask', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskFormRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('task.show', ['task' => $task['id']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
