<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Manager;
use Spatie\Permission\Models\Role;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $coordinatorRole = Role::where('name', 'coordinator')->first();

        $managerIds = Manager::whereHas('roles', function ($query) use ($adminRole, $coordinatorRole) {
            $query->whereIn('role_id', [$adminRole->id, $coordinatorRole->id]);
        })->pluck('id');

        $faker = Faker::create('vi_VN');

        $announcements = [
            'Thông báo lịch dã ngoại',
            'Thông báo tiền học phí tháng 3',
            'Thông báo nghỉ học vì thời tiết quá nóng',
            'Thông báo lịch nghỉ hè 2024'
        ];

        $details = [
            'Trường xin thông báo tới quý vị phụ huynh chi tiết lịch dã ngoại của các bé',
            'Trường xin thông báo tới quý vị phụ huynh chi tiết học phí của các bé',
            'Trường xin thông báo tới quý vị phụ huynh chi tiết lịch dã ngoại của các bé',
            'Trường xin thông báo tới quý vị phụ huynh chi tiết lịch nghỉ hè của các bé'
        ];

        foreach (range(0, 3) as $index) {
            DB::table('announcements')->insert([
                'content' => $announcements[$index] . "\n" . $details[$index],
                'sent_date' => $faker->dateTime(),
                'manager_id' => $managerIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
