<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = [
        'solution', 
        'grade', 
        'gradetext', 
        'checked', 
        'checked_at', 
        'uploaded_at', 
        'filename', 
        'uploaded', 
        'student_id', 
        'task_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
