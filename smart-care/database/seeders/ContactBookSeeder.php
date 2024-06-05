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
        $faker = Faker::create('vi_VN');
        $students = Student::all();

        foreach ($students as $student) {
            ContactBook::create([
                'height' => $faker->randomFloat(2, 80, 120),
                'weight' => $faker->randomFloat(2, 15, 30),
                'blood_group' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                'blood_pressure' => $faker->randomElement(['90/60', '100/70', '110/70']),
                'vision_test' => $faker->randomElement(['20/20', '20/25', '20/30']),
                'allergies' => $faker->randomElement(['Không', 'Các loại hạt', 'Sữa', 'Phấn hoa']),
                'total_absences' => $faker->numberBetween(0, 10),
                'good_behavior_certificates' => json_encode($this->generateGoodBehaviorCertificatesForAMonth()),
                'comment' => $faker->randomElement([
                    'Bé rất ngoan và chăm chỉ, tiếp thu bài học nhanh.',
                    'Cần khuyến khích bé tham gia các hoạt động nhóm nhiều hơn.',
                    'Bé rất năng động và yêu thích học hỏi.',
                    'Cần cải thiện kỹ năng giao tiếp, hơi nhút nhát với bạn bè.',
                    'Rất tốt trong các hoạt động ngoại khóa, đặc biệt là nghệ thuật.'
                ]),
                'student_id' => $student->id,
            ]);
        }
    }

    private function generateGoodBehaviorCertificatesForAMonth(): array
    {
        $weeks = [];
        for ($week = 1; $week <= 4; $week++) { 
            $weeks[] = [
                'week' => $week,
                'is_good' => (bool) random_int(0, 1) 
            ];
        }
        return $weeks;
    }
}
