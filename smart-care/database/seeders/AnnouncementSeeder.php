<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Manager; 
class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        $managerIds = Manager::all()->pluck('id');
        $manager_id = $managerIds->random();
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('announcements')->insert([
                'content' => $faker->paragraph,
                'sent_date' => $faker->dateTime(),
                'manager_id' => $manager_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
