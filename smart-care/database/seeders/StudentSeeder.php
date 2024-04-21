<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Classroom;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        $classroomIds = Classroom::all()->pluck('id');

        for ($i = 0; $i < 10; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $fullName = "$firstName $lastName";

            $asciiFirstName = Str::slug($firstName, '');
            $asciiLastName = Str::slug($lastName, '');
            $email = strtolower($asciiFirstName . $asciiLastName) . '@gmail.com';
            $username = strtolower($asciiFirstName . $asciiLastName);
            $dob = $faker->dateTimeBetween('-6 years', '-3 years')->format('Y-m-d');

            $avatarUrl = "https://picsum.photos/200/200?random=" . mt_rand(1000, 9999);

            Student::create([
                'name' => $fullName,
                'address' => $faker->address,
                'day_of_birth' => $dob,
                'email' => $email,
                'gender' => $faker->boolean,
                'profile_image' => $avatarUrl,
                'phone_number' => $faker->phoneNumber,
                'username' => $username,
                'password' => Hash::make('password'),
                'classroom_id' => $classroomIds->random(),
                'is_enable' => true,
            ]);
        }
    }
}
