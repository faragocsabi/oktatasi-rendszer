<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'teacher_id', 'description', 'code', 'credit', 'public',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
