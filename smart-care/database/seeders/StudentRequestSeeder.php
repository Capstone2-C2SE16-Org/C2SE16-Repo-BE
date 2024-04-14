<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Manager;

class StudentRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all student and manager IDs
        $studentIds = Student::all()->pluck('id');
        $managerIds = Manager::all()->pluck('id');

        // Generate student requests
        foreach (range(1, 20) as $index) {
            $student_id = $studentIds->random();
            $manager_id = $managerIds->random();

            DB::table('student_requests')->insert([
                'content' => $faker->paragraph,
                'status' => $faker->boolean(50), // 50% chance of being true
                'request_date' => $faker->dateTime(),
                'student_id' => $student_id,
                'manager_id' => $manager_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
