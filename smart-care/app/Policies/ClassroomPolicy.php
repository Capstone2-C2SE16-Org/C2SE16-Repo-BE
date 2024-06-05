<?php

namespace App\Policies;

use App\Models\Classroom;
use App\Models\Manager;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(Manager $manager, Classroom $classroom)
    {
        return $manager->roles->pluck('name')->contains('teacher') &&
            $manager->classrooms->contains($classroom);
    }

    // public function manage(Manager $manager, Classroom $classroom)
    // {
    //     return $manager->classrooms->contains($classroom->id) && $manager->hasRole('teacher');
    // }

    public function manage(Manager $manager, Classroom $classroom)
    {
        return $manager->classrooms()->where('classrooms.id', $classroom->id)->exists() && $manager->hasRole('teacher');
    }
}
