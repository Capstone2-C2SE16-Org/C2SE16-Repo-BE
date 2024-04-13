<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classroom::create([
            'classroom_type_id' => '1',
            'learning_schedule_id' => '1',
            'name' => 'lịch học lớp lớn 1',
        ]);

    }
}
