<?php

namespace Database\Seeders;

use App\Models\ContactBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactBook::create([
            'height' => '100',
            'weight' => '20',
            'blood_pressure' => '110/70',
            'vesion_test' => 'Normal',
            'total_absences' => '5',
            'transcript' => '8.75',
            'comment' => 'Bé rất yêu thích và khám phá về động vật',
            'student_id' => '1',
        ]);

        ContactBook::create([
            'height' => '103',
            'weight' => '19',
            'blood_pressure' => '110/60',
            'vesion_test' => 'Normal',
            'total_absences' => '2',
            'transcript' => '8.5',
            'comment' => 'Bé năng động và ăn uống tốt',
            'student_id' => '2',
        ]);

        ContactBook::create([
            'height' => '107',
            'weight' => '24',
            'blood_pressure' => '110/79',
            'vesion_test' => 'Normal',
            'total_absences' => '1',
            'transcript' => '9',
            'comment' => 'Bé rất quý mến bạn bè và chăm ngoan',
            'student_id' => '3',
        ]);

        ContactBook::create([
            'height' => '90',
            'weight' => '19',
            'blood_pressure' => '110/70',
            'vesion_test' => 'Normal',
            'total_absences' => '4',
            'transcript' => '8.9',
            'comment' => 'Bé rất thích học các môn vận động',
            'student_id' => '4',
        ]);
    }
}
