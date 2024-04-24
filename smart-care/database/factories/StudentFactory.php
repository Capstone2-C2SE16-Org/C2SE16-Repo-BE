<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $classroomIds = Classroom::all()->pluck('id');
        $classroom_id = $classroomIds->random();

        return [
            'name' => Str::random(10),
            'address' => Str::random(10),
            'day_of_birth'=>date('Y-m-d', strtotime('-' . rand(18, 65) . ' years')),
            'email' => Str::random(20) . '@example.com',
            'gender' => rand(0, 1),
            'profile_image' => null,
            'phone_number' => '123-456-' . rand(1000, 9999),
            'username' => Str::random(10),
            'password' => Hash::make('password'),
            'classroom_id' => $classroom_id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
