<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Manager;
use Illuminate\Database\Seeder;

class ClassroomManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managers = Manager::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        $classrooms = Classroom::all();

        foreach ($classrooms as $classroom) {
            $classroom->managers()->detach();
            $assignedManagers = $managers->random(rand(1, min(3, $managers->count())));
            foreach ($assignedManagers as $manager) {
                $classroom->managers()->attach($manager);
            }
        }
    }
}
