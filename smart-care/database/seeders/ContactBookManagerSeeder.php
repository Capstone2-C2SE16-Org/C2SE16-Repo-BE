<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\ContactBook;
use App\Models\Manager;

class ContactBookManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all contact book and manager IDs
        $contactBookIds = ContactBook::all()->pluck('id')->toArray();
        $managerIds = Manager::all()->pluck('id')->toArray();

        // Generate random relationships between contact books and managers
        foreach (range(1, 20) as $index) {
            $contact_book_id = $contactBookIds[array_rand($contactBookIds)];
            $manager_id = $managerIds[array_rand($managerIds)];

            // Check if the relationship already exists
            $existingRelationship = DB::table('contact_book_managers')
                ->where('contact_book_id', $contact_book_id)
                ->where('manager_id', $manager_id)
                ->exists();

            // If the relationship does not exist, insert it
            if (!$existingRelationship) {
                DB::table('contact_book_managers')->insert([
                    'contact_book_id' => $contact_book_id,
                    'manager_id' => $manager_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}


// class ContactBookManagerSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         $faker = Faker::create();

//         // Get all student and manager IDs
//         $contactbookIds = ContactBook::all()->pluck('id');
//         $managerIds = Manager::all()->pluck('id');

//         // Generate student requests
//         foreach (range(1, 10) as $index) {
//             $contact_book_id = $contactbookIds->random();
//             $manager_id = $managerIds->random();

//             DB::table('contacbookmanagers')->insert([
//                 'contact_book_id' => $contact_book_id,
//                 'manager_id' => $manager_id,
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
//         }
//     }
// }



// public function run(): void
// {
//     $contactbookIds = ContactBook::all()->pluck('id');
//     $contact_book_id = $contactbookIds->random();

//     $managerIds = Manager::all()->pluck('id');
//     $manager_id = $managerIds->random();
//     $faker = Faker::create();

//     foreach (range(1, 10) as $index) {
//         $randomIndex = array_rand($contactbookIds);
//         $student_id = $contactbookIds[$randomIndex]; 
//         unset($contactbookIds[$randomIndex]);
//         DB::table('contacbookmanagers')->insert([
//             'student_id' => $student_id,
//             'manager_id' => $manager_id,
//         ]);
//     }
// }