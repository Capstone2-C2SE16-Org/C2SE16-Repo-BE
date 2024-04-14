<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Database\Factories\StudentFactory;
use App\Models\Classroom;
use Illuminate\Support\Arr;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroomIds = Classroom::all()->pluck('id');
        $classroom_id = $classroomIds->random();

        $uniqueEmails = collect([]);

        Student::factory()->count(10)->create([
            'name' => Str::random(10),
            'address' => Str::random(10),
            'day_of_birth' => date('Y-m-d', strtotime('-' . rand(18, 65) . ' years')),
            'email' => function () use ($uniqueEmails) {
                $email = Str::random(10) . '@example.com';
                while ($uniqueEmails->contains($email)) {
                    $email = Str::random(10) . '@example.com';
                }
                $uniqueEmails->push($email);
                return $email;
            },
            'gender' => rand(0, 1),
            'profile_image' => null,
            'phone_number' => '123-456-' . rand(1000, 9999),
            'username' => Str::random(10),
            'password' => Hash::make('password'),
            'classroom_id' => $classroom_id,
        ]);
    }
}
