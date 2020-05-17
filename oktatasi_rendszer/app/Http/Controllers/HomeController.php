<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        $teachers = User::where('teacher', true)->count();
        $students = User::where('teacher', false)->count();
        return view('home')->with('teachers', $teachers)->with('students', $students);
    }
}
