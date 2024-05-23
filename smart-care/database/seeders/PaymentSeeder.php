<?php

namespace Database\Seeders;

use App\Models\Tuition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     $tuitions = Tuition::with('fee')->get(); 

    //     foreach ($tuitions as $tuition) {
    //         $fullAmount = $tuition->fee->price;
    //         $paymentStatus = rand(0, 2);  // Randomly decide if the payment is full, partial, or none

    //         $amountPaid = 0;
    //         switch ($paymentStatus) {
    //             case 0:
    //                 $amountPaid = 0; // Unpaid
    //                 break;
    //             case 1:
    //                 $amountPaid = $fullAmount; // Fully paid
    //                 break;
    //             case 2:
    //                 $amountPaid = rand($fullAmount / 2, $fullAmount - 1); // Partially paid, at least half
    //                 break;
    //         }

    //         Payment::create([
    //             'tuition_id' => $tuition->id,
    //             'status' => $amountPaid == $fullAmount ? 1 : 0,  // 1 if fully paid, 0 otherwise
    //             'total_amount' => $amountPaid,
    //             'date_of_payment' => $amountPaid > 0 ? Carbon::now()->subDays(rand(0, 30)) : null,  // Payment date within the last month if paid
    //             'tnx_ref' => 'TXN' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),  // Transaction reference number
    //         ]);
    //     }
    // }
}
