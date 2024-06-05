<?php

namespace Database\Seeders;

use App\Models\Manager;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tuition;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coordinators = Manager::role('coordinator')->get();

        foreach ($coordinators as $coordinator) {
            $tuitions = Tuition::where('manager_id', $coordinator->id)
                ->with('student', 'fee')
                ->get();

            $studentPayments = [];
            foreach ($tuitions as $tuition) {
                $studentId = $tuition->student_id;
                if (!isset($studentPayments[$studentId])) {
                    $studentPayments[$studentId] = 0;
                }
                $studentPayments[$studentId] += $tuition->fee->price ?? 0;
            }

            foreach ($studentPayments as $studentId => $totalAmount) {
                $tuitionId = Tuition::where('student_id', $studentId)->first()->id ?? null;
                if ($tuitionId) {
                    $payment = Payment::updateOrCreate(
                        ['tuition_id' => $tuitionId], 
                        [
                            'total_amount' => $totalAmount,
                            'status' => rand(0, 1),
                            'tnx_ref' => 'TXN' . uniqid(), 
                            'date_of_payment' => now(), 
                        ]
                    );
                    $payment->save();
                }
            }
        }
    }
}
