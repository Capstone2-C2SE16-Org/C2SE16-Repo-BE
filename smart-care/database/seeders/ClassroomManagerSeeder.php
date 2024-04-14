<?php

namespace Database\Seeders;

use App\Models\ClassroomManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        ClassroomManager::create([
            'manager_id' => '1',
            'classroom_id' => '1',
        ]);

        // ClassroomManager::create([
        //     'manager_id' => '2',
        //     'classroom_id' => '2',
        // ]);

        // ClassroomManager::create([
        //     'manager_id' => '3',
        //     'classroom_id' => '3',
        // ]);
        // ClassroomManager::create([
        //     'manager_id' => '4',
        //     'classroom_id' => '4',
        // ]);
    }
}
