<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Manager;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
//use Database\Factories\ManagerFactory;
use Faker\Factory as Faker;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('managers')->insert([
                'name' => $faker->name,
                'address' => $faker->address,
                'date_of_birth' => $faker->date,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'gender' => rand(0, 1),
                'profile_image' => $faker->imageUrl(),
                'phone_number' => $faker->phoneNumber,
                'username' => $faker->userName,
                'password' => Hash::make('password'), // You can set your desired default password here
                'is_enable' => $faker->boolean(90), // 90% chance of being true
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }






        // $uniqueEmails = collect([]);

        // Manager::create()->count(15)->create([
        //     'name' => Str::random(10),
        //     'address' => Str::random(10),
        //     'date_of_birth' => date('Y-m-d', strtotime('-' . rand(18, 65) . ' years')),
        //     'email' => function () use ($uniqueEmails) {
        //         $email = Str::random(10) . '@example.com';
        //         while ($uniqueEmails->contains($email)) {
        //             $email = Str::random(10) . '@example.com';
        //         }
        //         $uniqueEmails->push($email);
        //         return $email;
        //     },
        //     'gender' => rand(0, 1),
        //     'profile_image' => null,
        //     'phone_number' => '123-456-' . rand(1000, 9999),
        //     'username' => Str::random(10),
        //     'password' => Hash::make('password'),
        // ]);

        // Manager::create([
        //     'name' => 'Đỗ Tiến Thành',
        //     'address' => 'Đà Nẵng',
        //     'date_of_birth'=>'2001-1-1',
        //     'email' => 'thanhday@gmail.com',
        //     'gender' => '1',
        //     'profile_image' => 'string',
        //     'phone_number' => '123456789',
        //     'username' => 'thanhcute1',
        //     'password' => Hash::make('thanhcute1'),
        // ]);

        // Manager::create([
        //     'name' => 'Võ Văn Hảo',
        //     'address' => 'Quảng Nam',
        //     'date_of_birth'=>'2002-03-20',
        //     'email' => 'haovo@gmail.com',
        //     'gender' => '1',
        //     'profile_image' => 'string',
        //     'phone_number' => '12345678910',
        //     'username' => 'haocute1',
        //     'password' => Hash::make('haocute1'),
        // ]);

        // Manager::create([
        //     'name' => 'Nguyễn Cửu Hoàng Hải',
        //     'address' => 'Huế',
        //     'date_of_birth'=>'2002-1-17',
        //     'email' => 'hai@gmail.com',
        //     'gender' => '1',
        //     'profile_image' => 'string',
        //     'phone_number' => '777777777777',
        //     'username' => 'haiday10',
        //     'password' => Hash::make('haiday1'),

        // ]);

        // Manager::create([
        //     'name' => 'Nguyễn Như Ngọc',
        //     'address' => 'Hà Tĩnh',
        //     'date_of_birth'=>'2002-1-10',
        //     'email' => 'ngoc@gmail.com',
        //     'gender' => '0',
        //     'profile_image' => 'string',
        //     'phone_number' => '19999999999999',
        //     'username' => 'nocnoc1',
        //     'password' => Hash::make('ngocne1709'),

        // ]);

        // Manager::create([
        //     'name' => 'Nguyễn Thị Lan',
        //     'address' => 'Bình Định',
        //     'date_of_birth'=>'2007-1-10',
        //     'email' => 'aaaaaa@gmail.com',
        //     'gender' => '0',
        //     'profile_image' => 'string',
        //     'phone_number' => '19999999999999',
        //     'username' => 'aaaa1',
        //     'password' => Hash::make('auo1999'),
        // ]);
    }
}
