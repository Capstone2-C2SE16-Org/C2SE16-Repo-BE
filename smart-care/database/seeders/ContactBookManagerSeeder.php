<?php

namespace Database\Seeders;

use App\Models\ContactBook;
use App\Models\ContactBookManager;
use App\Models\Manager;
use Illuminate\Database\Seeder;

class ContactBookManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contactBooks = ContactBook::all();
        $teachers = Manager::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();

        foreach ($contactBooks as $contactBook) {
            ContactBookManager::create([
                'contact_book_id' => $contactBook->id,
                'manager_id' => $teachers->random()->id,
            ]);
        }
    }
}
