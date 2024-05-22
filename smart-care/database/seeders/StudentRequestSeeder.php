<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Manager;
use Spatie\Permission\Models\Role;

class StudentRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        $studentIds = Student::all()->pluck('id');

        $teacherRole = Role::where('name', 'teacher')->first();
        $managerIds = Manager::role($teacherRole)->pluck('id');

        $fixedReturnDate = now()->addWeeks(2)->format('Y-m-d');

        foreach (range(1, 20) as $index) {
            $student_id = $studentIds->random();
            $manager_id = $managerIds->random();

            $reasons = ['sốt', 'ho', 'đau bụng', 'nôn/buồn nôn', 'đau mắt', 'có việc gia đình'];
            $otherReasons = [
                'Gia đình có việc cần giải quyết gấp',
                'Có lịch hẹn với bác sĩ',
                'Đi thăm họ hàng ở xa',
            ];

            if ($faker->boolean()) { 
                $selectedReason = $faker->randomElement($reasons);
                $otherReason = null;
            } else { 
                $selectedReason = null;
                $otherReason = $faker->randomElement($otherReasons);
            }

            DB::table('student_requests')->insert([
                'reason' => $selectedReason,
                'other_reason' => $otherReason,
                'leave_date' => $faker->dateTimeThisYear()->format('Y-m-d'),
                'return_date' => $fixedReturnDate,
                'status' => $faker->boolean(50),
                'request_date' => $faker->dateTimeThisYear(),
                'student_id' => $student_id,
                'manager_id' => $manager_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
