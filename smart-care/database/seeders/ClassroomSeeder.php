<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\ClassroomType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroomTypes = ClassroomType::all();

        foreach ($classroomTypes as $type) {
            for ($i = 1; $i <= 3; $i++) {
                Classroom::create([
                    'name' => "{$type->name} {$i}",
                    'classroom_type_id' => $type->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
