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
            'name' => 'Lop nho',
            'classroom_type_id' => '1',
        ]);

        Classroom::create([
            'name' => 'Lop lon',
            'classroom_type_id' => '2',
        ]);
    }
}
