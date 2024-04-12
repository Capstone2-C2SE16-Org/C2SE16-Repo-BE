<?php

namespace Database\Seeders;

use App\Models\Parents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Parents::create([
            'name' => 'Bo Van A',
            'date_of_birth' => '1990-2-2',
            'gender' => '1',
            'student_id' => '1',
        ]);

        Parents::create([
            'name' => 'Me Van B',
            'date_of_birth' => '1995-2-2',
            'gender' => '2',
            'student_id' => '2',
        ]);
    }
}
