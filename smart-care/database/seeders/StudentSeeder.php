<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
                'name' => 'Be Hai',
                'address' => 'Da Nang',
                'day_of_birth'=>'2020-1-1',
                'email' => 'haiday@gmail.com',
                'gender' => '1',
                'profile_image' => 'string',
                'phone_number' => '123456789',
                'username' => 'behai1',
                'password' => 'behai1',
                'classroom_id' => '1'
        ]);

        Student::create([
            'name' => 'Be Ba',
            'address' => 'Da Nang',
            'day_of_birth'=>'2020-1-1',
            'email' => 'baday@gmail.com',
            'gender' => '0',
            'profile_image' => 'string',
            'phone_number' => '123456789456456',
            'username' => 'beba1',
            'password' => 'beba1',
            'classroom_id' => '1'
        ]);

        Student::create([
            'name' => 'Be Bon',
            'address' => 'Da Nang',
            'day_of_birth'=>'2020-1-1',
            'email' => 'bonday@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '123456789',
            'username' => 'bebon1',
            'password' => 'bebon1',
            'classroom_id' => '1'
        ]);

        Student::create([
            'name' => 'Be Nam',
            'address' => 'Da Nang',
            'day_of_birth'=>'2020-1-1',
            'email' => 'namday@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '123456789',
            'username' => 'benam5',
            'password' => 'benam',
            'classroom_id' => '2'
        ]);

        Student::create([
            'name' => 'Be Sau',
            'address' => 'Da Nang',
            'day_of_birth'=>'2020-1-1',
            'email' => 'sauday@gmail.com',
            'gender' => '0',
            'profile_image' => 'string',
            'phone_number' => '12666663456789',
            'username' => 'besau6',
            'password' => 'besau6',
            'classroom_id' => '2'
        ]);

        Student::create([
            'name' => 'Be Hai',
            'address' => 'Da Nang',
            'day_of_birth'=>'2020-1-1',
            'email' => 'haiday@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '123456789',
            'username' => 'behai1',
            'password' => 'behai1',
            'classroom_id' => '1'
        ]);

        Student::create([
            'name' => 'Be Hai',
            'address' => 'Da Nang',
            'day_of_birth'=>'2020-1-1',
            'email' => 'haiday@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '123456789',
            'username' => 'behai1',
            'password' => 'behai1',
            'classroom_id' => '1'
        ]);

        Student::create([
            'name' => 'Be Hai',
            'address' => 'Da Nang',
            'day_of_birth'=>'2020-1-1',
            'email' => 'haiday@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '123456789',
            'username' => 'behai1',
            'password' => 'behai1',
            'classroom_id' => '1'
        ]);


    }
}
