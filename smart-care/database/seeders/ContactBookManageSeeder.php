<?php

namespace Database\Seeders;

use App\Models\ContactBookManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactBookManageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactBookManager::create([
            'contact_book_id' => '1',
            'manager_id' => '1',
        ]);

        ContactBookManager::create([
            'contact_book_id' => '1',
            'manager_id' => '1',
        ]);
    }
}
