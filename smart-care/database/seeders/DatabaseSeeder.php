<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ManagerSeeder::class,
            AnnouncementSeeder::class,
            ClassroomTypeSeeder::class,
            LearningScheduleSeeder::class,
            ClassroomSeeder::class,
            StudentSeeder::class,
            ParentSeeder::class,
            //ClassroomLearningScheduleSeeder::class,
            ClassroomManagerSeeder::class,
            CameraSeeder::class,
            StudentRequestSeeder::class,
            ContactBookSeeder::class,
            ContactBookManageSeeder::class,

            FeesSeeder::class,
            TuitionSeeder::class,
            PaymentSeeder::class,
            MealScheduleSeeder::class,
            ManagerRoleSeeder::class,
        ]);




        // DB::table('Manager')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@example.com',
        //     'password' => Hash::make('password'),
        // ]);
    }
}
