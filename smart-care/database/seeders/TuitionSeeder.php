<?php

namespace Database\Seeders;

use App\Models\Fee;
use App\Models\Manager;
use App\Models\Student;
use App\Models\Tuition;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TuitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $fees = Fee::all();

        $coordinators = Manager::role('coordinator')->get();

        $shuffledCoordinators = $coordinators->shuffle();

        foreach ($students as $index => $student) {

            $coordinator = $shuffledCoordinators->get($index % $shuffledCoordinators->count());

            foreach ($fees as $fee) {
                Tuition::create([
                    'status' => rand(0, 1),
                    'date_of_payment' => Carbon::now(),
                    'is_paid' => rand(0, 1),
                    'manager_id' => $coordinator->id,
                    'student_id' => $student->id,
                    'fee_id' => $fee->id,
                ]);
            }
        }
    }
}
