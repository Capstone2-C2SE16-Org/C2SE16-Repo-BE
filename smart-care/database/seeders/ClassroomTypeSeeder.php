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
            'name' => 'Lớp lớn 1',
        ]);
        
        ClassroomType::create([
            'name' => 'Lớp lớn 2',
        ]);

        ClassroomType::create([
            'name' => 'Lớp bé 1',
        ]);

        ClassroomType::create([
            'name' => 'Lớp bé 2',
        ]);

    }
}
