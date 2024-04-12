<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Manager::create([
            'name' => 'Do Tien Thanh',
            'address' => 'Da Nang',
            'day_of_birth'=>'2001-1-1',
            'email' => 'thanhday@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '123456789',
            'username' => 'thanhcute1',
            'password' => 'thanhcute1',
        ]);

        Manager::create([
            'name' => 'Vo Van Hao',
            'address' => 'Quang Nam',
            'day_of_birth'=>'2002-03-20',
            'email' => 'haovo@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '12345678910',
            'username' => 'haocute1',
            'password' => 'haocute1',
        ]);

        Manager::create([
            'name' => 'Nguyen Cuu Hoang Hai',
            'address' => 'Hue',
            'day_of_birth'=>'2002-1-17',
            'email' => 'hai@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '777777777777',
            'username' => 'haiday10',
            'password' => 'haiday10',
        ]);

        Manager::create([
            'name' => 'Nguyen Nhu Ngoc',
            'address' => 'Ha Tinh',
            'day_of_birth'=>'2002-1-10',
            'email' => 'ngoc@gmail.com',
            'gender' => '0',
            'profile_image' => 'string',
            'phone_number' => '19999999999999',
            'username' => 'nocnoc1',
            'password' => 'nocnoc1',
        ]);

        Manager::create([
            'name' => 'Nguyen Van A',
            'address' => 'Binh Dinh',
            'day_of_birth'=>'2007-1-10',
            'email' => 'aaaaaa@gmail.com',
            'gender' => '0',
            'profile_image' => 'string',
            'phone_number' => '19999999999999',
            'username' => 'aaaa1',
            'password' => 'aaaa1',
        ]);
    }
}
