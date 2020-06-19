<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;
use App\Solution;
use App\Subject;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $teachers = User::where('is_teacher', '1')->count();
        $students = User::where('is_teacher', '0')->count();
        $tasks = Task::all()->count();
        $solutions = Solution::all()->count();
        return view('home')
            ->with('teachers', $teachers)
            ->with('students', $students)
            ->with('tasks', $tasks)
            ->with('solutions', $solutions);
    }

    public function insideMain()
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
}
