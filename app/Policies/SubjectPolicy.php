<?php

namespace App\Policies;

use App\Subject;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class SubjectPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Subject $subject)
    {
        if(Auth::user()->is_teacher === '1') {
            return Auth::user()->teacher->id === $subject->teacher->id;
        }
        else {
            return false;
        }
    }
}
