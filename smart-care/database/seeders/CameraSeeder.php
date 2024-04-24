<?php

namespace Database\Seeders;

use App\Models\Camera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Classroom; 

class CameraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Camera::create([
        //     'location' => 'Lop nho',
        //     'classroom_type_id' => 1,
        // ]); 

        $classroomIds = Classroom::all()->pluck('id');
        $classroom_id = $classroomIds->random();
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('cameras')->insert([
                'location' => $faker->address,
                'status' => $faker->boolean(80), // 80% chance of being true
                'classroom_id' => $classroom_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
