<?php

namespace Database\Seeders;

use App\Models\ClassroomType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClassroomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassroomType::insert([
            [
                'name' => 'Lớp bé',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lớp lớn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
