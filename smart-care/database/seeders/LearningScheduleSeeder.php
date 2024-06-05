<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\LearningSchedule;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;


class LearningScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        $fixedNoonActivities = "Ăn trưa\nNghỉ trưa";

        $morningActivities = [
            "Vận động",
            "VD minh họa theo bài Bé tập thể dục",
            "Học vần",
            "Toán đơn giản",
        ];

        $afternoonActivities = [
            "Làm bài tập Toán sắp xếp theo thứ tự tăng dần, giảm dần",
            "Rèn kĩ năng thực hành cuộc sống: Rót nước tự bình sang ly",
            "Thực hành thí nghiệm khoa học",
            "Học tiếng Anh qua bài hát",
        ];

        $startOfWeek = Carbon::now()->startOfWeek();
        $classrooms = Classroom::all();

        foreach ($classrooms as $classroom) {
            LearningSchedule::where('name', 'LIKE', '%' . $classroom->name . '%')
                ->whereBetween('date', [$startOfWeek, $startOfWeek->copy()->endOfWeek()])
                ->delete();

            for ($dayIndex = 0; $dayIndex < 5; $dayIndex++) {
                $date = $startOfWeek->copy()->addDays($dayIndex);

                $scheduleName = "Lịch học {$classroom->name}";

                LearningSchedule::create([
                    'name' => $scheduleName,
                    'date' => $date,
                    'morning' => implode("\n", $faker->randomElements($morningActivities, 2)),
                    'noon' => $fixedNoonActivities,
                    'afternoon' => implode("\n", $faker->randomElements($afternoonActivities, 2)),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
