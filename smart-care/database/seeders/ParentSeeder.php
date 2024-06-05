<?php

namespace Database\Seeders;

use App\Models\Parents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Student; 

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        $students = Student::all();

        foreach ($students as $student) {
            $lastName = $faker->lastName;
            $middleName = $faker->lastName;
            $firstName = $faker->firstName;
            $fullName = "$lastName $middleName $firstName";

            $dob = $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d');

            DB::table('parents')->insert([
                'name' => $fullName,
                'date_of_birth' => $dob,
                'gender' => $faker->numberBetween(0, 1),
                'student_id' => $student->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
