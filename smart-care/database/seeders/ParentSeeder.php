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
        $faker = Faker::create();
        $studentIds = Student::all()->pluck('id')->toArray(); // Xóa `student_id` đã chọn để không sử dụng lại
        foreach (range(1, 10) as $index) {
            $randomIndex = array_rand($studentIds);// Xóa `student_id` đã chọn để không sử dụng lại
            $student_id = $studentIds[$randomIndex]; // Xóa `student_id` đã chọn để không sử dụng lại
            unset($studentIds[$randomIndex]); // Xóa `student_id` đã chọn để không sử dụng lại
            DB::table('parents')->insert([
                'name' => $faker->name,
                'date_of_birth' => $faker->date,
                'gender' => $faker->numberBetween(0, 1),
                'student_id' => $student_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
