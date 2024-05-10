<?php

namespace Database\Seeders;

use App\Models\ContactBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Student;

class ContactBookSeeder extends Seeder
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

        foreach ($studentIds as $student_id) {
            $randomIndex = array_rand($studentIds);// Xóa `student_id` đã chọn để không sử dụng lại
            $student_id = $studentIds[$randomIndex]; // Xóa `student_id` đã chọn để không sử dụng lại
            unset($studentIds[$randomIndex]);
            DB::table('contact_books')->insert([
                'height' => $faker->numberBetween(140, 200), // Assuming height is in cm
                'weight' => $faker->numberBetween(30, 150), // Assuming weight is in kg
                'blood_pressure' => $faker->randomElement(['120/80', '130/85', '140/90']), // Example blood pressure values
                'vision_test' => $faker->randomElement(['Normal', 'Myopia', 'Hyperopia']), // Example vision test results
                'total_absences' => $faker->numberBetween(0, 10),
                'transcript' => $faker->randomFloat(2, 0, 10), // Assuming transcript is on a 0-10 scale
                'comment' => $faker->paragraph,
                'student_id' => $student_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } 


    //     ContactBook::create([
    //         'height' => '100',
    //         'weight' => '20',
    //         'blood_pressure' => '110/70',
    //         'vision_test' => 'Normal',
    //         'total_absences' => '5',
    //         'transcript' => '8.75',
    //         'comment' => 'Bé rất yêu thích và khám phá về động vật',
    //         'student_id' => '1',
    //     ]);

    }
}
