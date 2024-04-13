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
            'name' => 'Đỗ Tiến Thành',
            'address' => 'Đà Nẵng',
            'day_of_birth'=>'2001-1-1',
            'email' => 'thanhday@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '123456789',
            'username' => 'thanhcute1',
            'password' => Hash::make('thanhcute1'),
        ]);

        Manager::create([
            'name' => 'Võ Văn Hảo',
            'address' => 'Quảng Nam',
            'day_of_birth'=>'2002-03-20',
            'email' => 'haovo@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '12345678910',
            'username' => 'haocute1',
            'password' => Hash::make('haocute1'),
        ]);

        Manager::create([
            'name' => 'Nguyễn Cửu Hoàng Hải',
            'address' => 'Huế',
            'day_of_birth'=>'2002-1-17',
            'email' => 'hai@gmail.com',
            'gender' => '1',
            'profile_image' => 'string',
            'phone_number' => '777777777777',
            'username' => 'haiday10',
            'password' => Hash::make('haiday1'),

        ]);

        Manager::create([
            'name' => 'Nguyễn Như Ngọc',
            'address' => 'Hà Tĩnh',
            'day_of_birth'=>'2002-1-10',
            'email' => 'ngoc@gmail.com',
            'gender' => '0',
            'profile_image' => 'string',
            'phone_number' => '19999999999999',
            'username' => 'nocnoc1',
            'password' => Hash::make('ngocne1709'),

        ]);

        Manager::create([
            'name' => 'Nguyễn Thị Lan',
            'address' => 'Bình Định',
            'day_of_birth'=>'2007-1-10',
            'email' => 'aaaaaa@gmail.com',
            'gender' => '0',
            'profile_image' => 'string',
            'phone_number' => '19999999999999',
            'username' => 'aaaa1',
            'password' => Hash::make('auo1999'),
        ]);
    }
}
