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
        $teachers = Manager::role('teacher')->get(); 
        $classrooms = Classroom::all();

        foreach ($classrooms as $classroom) {
            $classroom->managers()->detach(); 
        }

        foreach ($teachers as $teacher) {
            $numberOfClassroomsToAssign = rand(1, 2);

            $assignedClassrooms = $classrooms->random($numberOfClassroomsToAssign);
            foreach ($assignedClassrooms as $classroom) {
                $classroom->managers()->attach($teacher); 
            }
        }
    }
}
