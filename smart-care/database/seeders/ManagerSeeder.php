<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager;
use App\Models\Ward;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $permissions = [
            'managers.list',
            'managers.view',
            'managers.create',
            'managers.update',
            'managers.delete',
            'meal_schedules.view',
            'meal_schedules.create',
            'meal_schedules.update',
            'meal_schedules.delete',
            'student_requests.create',
            'student_requests.view',
            'student_requests.update',
            'student_requests.delete',
            'classrooms.view',
            'classrooms.manage',
            'learning_schedules.view',
            'learning_schedules.create',
            'learning_schedules.update',
            'learning_schedules.delete',
            'contact_books.view',
            'contact_books.create',
            'contact_books.update',
            'contact_books.delete',
            'tuitions.view',
            'tuitions.create',
            'tuitions.update',
            'tuitions.delete',
            'students.list',
            'students.view',
            'students.create',
            'students.update',
            'students.delete',
            'locations.view',
            'announcements.view',     
            'announcements.create',      
            'announcements.update',      
            'announcements.delete',  
            'teachers.view',    
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin_role = Role::firstOrCreate(['name' => 'admin']);
        $admin_role->givePermissionTo($permissions);

        $admin = Manager::firstOrCreate([
            'email' => 'capstone2c2se16@gmail.com'
        ], [
            'name' => 'Admin',
            'address' => 'Da Nang',
            'date_of_birth' => '2000-01-01',
            'email_verified_at' => now(),
            'gender' => '1',
            'profile_image' => 'https://png.pngtree.com/png-vector/20220810/ourlarge/pngtree-client-icon-manager-avatar-chief-vector-png-image_19468048.jpg',
            'phone_number' => '0905123434',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'is_enable' => 1,
            'remember_token' => Str::random(10),
            'ward_id' => 6389,
            'district_id' => 358,
            'province_id' => 32
        ]);

        $admin->syncRoles($admin_role);
        $admin->givePermissionTo($permissions);

        $teacher_permissions = [
            'managers.list',
            'managers.view',
            'student_requests.view',
            'student_requests.update',
            'student_requests.delete',
            'classrooms.view',
            'classrooms.manage',
            'learning_schedules.view',
            'learning_schedules.create',
            'learning_schedules.update',
            'learning_schedules.delete',
            'contact_books.view',
            'contact_books.create',
            'contact_books.update',
            'contact_books.delete',
            'teachers.view'
        ];

        $teacher_role = Role::firstOrCreate(['name' => 'teacher']);
        $teacher_role->givePermissionTo($teacher_permissions);

        $coordinator_permissions = [
            'managers.list',
            'managers.view',
            'meal_schedules.view',
            'meal_schedules.create',
            'meal_schedules.update',
            'meal_schedules.delete',
            'tuitions.create',
            'tuitions.view',
            'tuitions.update',
            'tuitions.delete',
            'announcements.view',     
            'announcements.create',      
            'announcements.update',      
            'announcements.delete',    
        ];

        $coordinator_role = Role::firstOrCreate(['name' => 'coordinator']);
        $coordinator_role->givePermissionTo($coordinator_permissions);

        $faker = Faker::create('vi_VN');

        if (Ward::count() == 0) {
            $this->command->info('No wards found. Please run the import command: php artisan vietnamzone:import');
            return;
        }

        foreach (range(1, 20) as $index) {
            $lastName = $faker->lastName;
            $middleName = $faker->lastName;
            $firstName = $faker->firstName;
            $fullName = "$lastName $middleName $firstName";

            $asciiLastName = Str::slug($lastName, '');
            $asciiMiddleName = Str::slug($middleName, '');
            $asciiFirstName = Str::slug($firstName, '');
            $email = strtolower($asciiLastName . $asciiMiddleName . $asciiFirstName) . '@gmail.com';
            $username = strtolower($asciiLastName . $asciiMiddleName . $asciiFirstName);

            $ward = Ward::inRandomOrder()->first();
            $district = $ward->district;
            $province = $district->province;

            $address = $faker->streetAddress . ', ' . $ward->name . ', ' . $district->name . ', ' . $province->name;

            $manager = Manager::create([
                'name' => $fullName,
                'address' => $address,
                'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                'email' => $email,
                'email_verified_at' => now(),
                'gender' => rand(0, 1),
                'profile_image' => "https://picsum.photos/200/200?random=" . mt_rand(1000, 9999),
                'phone_number' => $faker->phoneNumber,
                'username' => $username,
                'password' => Hash::make('password'),
                'is_enable' => true,
                'remember_token' => Str::random(10),
                'ward_id' => $ward->id,
                'district_id' => $district->id,
                'province_id' => $province->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $assignedRole = $faker->randomElement([$teacher_role, $coordinator_role]);
            $manager->assignRole($assignedRole);

            if ($assignedRole->name === 'teacher') {
                $manager->givePermissionTo($teacher_permissions);
            } else if ($assignedRole->name === 'coordinator') {
                $manager->givePermissionTo($coordinator_permissions);
            }
        }
    }
}
