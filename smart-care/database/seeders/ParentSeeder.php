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
        $studentIds = Student::all()->pluck('id');
        $student_id = $studentIds->random();
        $faker = Faker::create('vi_VN');
        $studentIds = Student::all()->pluck('id')->toArray(); 
        foreach (range(1, 20) as $index) {
            $lastName = $faker->lastName; 
            $middleName = $faker->lastName; 
            $firstName = $faker->firstName; 
            $fullName = "$lastName $middleName $firstName";

            $dob = $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d');

            $randomIndex = array_rand($studentIds);
            $student_id = $studentIds[$randomIndex]; 
            unset($studentIds[$randomIndex]);
            DB::table('parents')->insert([
                'name' => $fullName,
                'date_of_birth' => $dob,
                'gender' => $faker->numberBetween(0, 1),
                'student_id' => $student_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
