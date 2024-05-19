<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Classroom;
use App\Models\Ward;
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
        $diminutives = ['Bé', 'Tiểu', 'Nho', 'Chibi']; 

        if (Ward::count() == 0) {
            $this->command->info('No wards found. Please run the import command: php artisan vietnamzone:import');
            return;
        }

        for ($i = 0; $i < 20; $i++) {
            $lastName = $faker->lastName; 
            $middleName = $faker->lastName; 
            $firstName = $faker->firstName; 
            $fullName = "$lastName $middleName $firstName";

            $nickname = $diminutives[array_rand($diminutives)] . ' ' . $firstName . ' ' . $this->randomEmoji();

            $asciiLastName = Str::slug($lastName, '');
            $asciiMiddleName = Str::slug($middleName, '');
            $asciiFirstName = Str::slug($firstName, '');
            $email = strtolower($asciiLastName. $asciiMiddleName . $asciiFirstName) . '@gmail.com';
            $username = strtolower($asciiLastName. $asciiMiddleName . $asciiFirstName);
            $dob = $faker->dateTimeBetween('-6 years', '-3 years')->format('Y-m-d');

            $avatarUrl = "https://picsum.photos/200/200?random=" . mt_rand(1000, 9999);

            $ward = Ward::inRandomOrder()->first();
            $district = $ward->district;
            $province = $district->province;

            $address = $faker->streetAddress . ', ' . $ward->name . ', ' . $district->name . ', ' . $province->name;

            Student::create([
                'name' => $fullName,
                'nickname' => $nickname,
                'address' => $address,
                'date_of_birth' => $dob,
                'email' => $email,
                'gender' => $faker->boolean,
                'profile_image' => $avatarUrl,
                'phone_number' => $faker->phoneNumber,
                'username' => $username,
                'password' => Hash::make('password'),
                'classroom_id' => $classroomIds->random(),
                'ward_id' => $ward->id,
                'is_enable' => true,
            ]);
        }
    }

    private function randomEmoji() {
        $emojis = ['🌟', '🚀', '🎈', '🌸', '🐾'];
        return $emojis[array_rand($emojis)];
    }
}
