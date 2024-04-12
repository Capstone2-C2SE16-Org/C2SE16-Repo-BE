<?php

namespace Database\Seeders;

use App\Models\Camera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CameraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Camera::create([
            'location' => 'Lop nho',
            'classroom_type_id' => '1',
        ]);

        Camera::create([
            'location' => 'Lop lon',
            'classroom_type_id' => '2',
        ]);
    }
}
