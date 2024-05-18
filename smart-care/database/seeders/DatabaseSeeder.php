<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            ClassroomSeeder::class,
            LearningScheduleSeeder::class,
            ClassroomLearningScheduleSeeder::class,
            StudentSeeder::class,
            ParentSeeder::class,
            ClassroomManagerSeeder::class,
            CameraSeeder::class,
            StudentRequestSeeder::class,
            ContactBookSeeder::class,
            ContactBookManagerSeeder::class,
            FeesSeeder::class,
            TuitionSeeder::class,
            PaymentSeeder::class,
            MealScheduleSeeder::class,
            ManagerRoleSeeder::class,
        ]);
    }
}
