<?php

namespace Database\Seeders;

use App\Models\LearningSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class LearningScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        LearningSchedule::create([
            'name' => 'Lịch Lớp lớn 1',
            'date' => date('Y-m-d', strtotime('-' . rand(18, 65) . ' years')),
            'morning' => Str::random(8),
            'noon' => Str::random(8),
            'afternoon' => Str::random(8),
        ]);

        LearningSchedule::create([
            'name' => 'Lịch Lớp lớn 2',
            'date' => date('Y-m-d', strtotime('-' . rand(18, 65) . ' years')),
            'morning' => Str::random(8),
            'noon' => Str::random(8),
            'afternoon' => Str::random(8),
        ]);

        LearningSchedule::create([
            'name' => 'Lịch Lớp bé 1',
            'date' => date('Y-m-d', strtotime('-' . rand(18, 65) . ' years')),
            'morning' => Str::random(8),
            'noon' => Str::random(8),
            'afternoon' => Str::random(8),
        ]);

        LearningSchedule::create([
            'name' => 'Lịch Lớp bé 2',
            'date' => date('Y-m-d', strtotime('-' . rand(18, 65) . ' years')),
            'morning' => Str::random(8),
            'noon' => Str::random(8),
            'afternoon' => Str::random(8),
        ]);
    }
}
