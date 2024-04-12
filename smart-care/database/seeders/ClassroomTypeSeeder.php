<?php

namespace Database\Seeders;

use App\Models\ClassroomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassroomType::create([
            'classroomid' => '1',
            'learning_schedule_id' => '1',
        ]);

        ClassroomType::create([
            'classroomid' => '2',
            'learning_schedule_id' => '2',
        ]);
    }
}
