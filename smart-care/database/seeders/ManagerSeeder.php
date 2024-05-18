<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager;
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
        $manager_list = Permission::create(['name' => 'managers.list']);
        $manager_view = Permission::create(['name' => 'managers.view']);
        $manager_create = Permission::create(['name' => 'managers.create']);
        $manager_update = Permission::create(['name' => 'managers.update']);
        $manager_delete = Permission::create(['name' => 'managers.delete']);

        $meal_schedule_view = Permission::create(['name' => 'meal_schedules.view']);
        $meal_schedule_create = Permission::create(['name' => 'meal_schedules.create']);
        $meal_schedule_update = Permission::create(['name' => 'meal_schedules.update']);
        $meal_schedule_delete = Permission::create(['name' => 'meal_schedules.delete']);

        $student_request_create = Permission::create(['name' => 'student_requests.create']);
        $student_request_view = Permission::create(['name' => 'student_requests.view']);
        $student_request_update = Permission::create(['name' => 'student_requests.update']);
        $student_request_delete = Permission::create(['name' => 'student_requests.delete']);

        $classroom_view = Permission::create(['name' => 'classrooms.view']);
        $classroom_manage = Permission::create(['name' => 'classrooms.manage']);

        $learning_schedule_view = Permission::create(['name' => 'learning_schedules.view']);
        $learning_schedule_create = Permission::create(['name' => 'learning_schedules.create']);
        $learning_schedule_update = Permission::create(['name' => 'learning_schedules.update']);
        $learning_schedule_delete = Permission::create(['name' => 'learning_schedules.delete']);

        $contact_book_view = Permission::create(['name' => 'contact_books.view']);
        $contact_book_create = Permission::create(['name' => 'contact_books.create']);
        $contact_book_update = Permission::create(['name' => 'contact_books.update']);
        $contact_book_delete = Permission::create(['name' => 'contact_books.delete']);

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            $manager_create,
            $manager_list,
            $manager_update,
            $manager_view,
            $manager_delete,
            $meal_schedule_view,
            $meal_schedule_create,
            $meal_schedule_update,
            $meal_schedule_delete,
            $student_request_view,
            $student_request_update,
            $student_request_delete,
            $classroom_view,
            $classroom_manage,
            $learning_schedule_view,
            $learning_schedule_create,
            $learning_schedule_update,
            $learning_schedule_delete,
            $contact_book_view,
            $contact_book_create,
            $contact_book_update,
            $contact_book_delete,
        ]);

        $admin = Manager::create([
            'name' => 'Admin',
            'address' => 'Da Nang',
            'date_of_birth' => '2000-01-01',
            'email' => 'capstone2c2se16@gmail.com',
            'email_verified_at' => now(),
            'gender' => '1',
            'profile_image' => 'https://png.pngtree.com/png-vector/20220810/ourlarge/pngtree-client-icon-manager-avatar-chief-vector-png-image_19468048.jpg',
            'phone_number' => '0905123434',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'is_enable' => 1,
            'remember_token' => Str::random(10),
        ]);

        $admin->syncRoles($admin_role);
        $admin->givePermissionTo([
            $manager_create,
            $manager_list,
            $manager_update,
            $manager_view,
            $manager_delete,
            $meal_schedule_view,
            $meal_schedule_create,
            $meal_schedule_update,
            $meal_schedule_delete,
            $student_request_view,
            $student_request_update,
            $student_request_delete,
            $classroom_view,
            $classroom_manage,
            $learning_schedule_view,
            $learning_schedule_create,
            $learning_schedule_update,
            $learning_schedule_delete,
            $contact_book_view,
            $contact_book_create,
            $contact_book_update,
            $contact_book_delete,
        ]);

        $teacher_role = Role::create(['name' => 'teacher']);
        $teacher_role->givePermissionTo([
            $manager_list,
            $manager_view,
            $student_request_view,
            $student_request_update,
            $classroom_view,
            $classroom_manage,
            $learning_schedule_view,
            $learning_schedule_create,
            $learning_schedule_update,
            $learning_schedule_delete,
            $contact_book_view,
            $contact_book_create,
            $contact_book_update,
            $contact_book_delete,
        ]);

        $coordinator_role = Role::create(['name' => 'coordinator']);
        $coordinator_role->givePermissionTo([
            $manager_list,
            $manager_view,
            $meal_schedule_view,
            $meal_schedule_create,
            $meal_schedule_update,
            $meal_schedule_delete,
        ]);

        $faker = Faker::create('vi_VN');

        foreach (range(1, 10) as $index) {
            $lastName = $faker->lastName; 
            $middleName = $faker->lastName; 
            $firstName = $faker->firstName; 
            $fullName = "$lastName $middleName $firstName";

            $asciiLastName = Str::slug($lastName, '');
            $asciiMiddleName = Str::slug($middleName, '');
            $asciiFirstName = Str::slug($firstName, '');
            $email = strtolower($asciiLastName. $asciiMiddleName . $asciiFirstName) . '@gmail.com';
            $username = strtolower($asciiLastName. $asciiMiddleName . $asciiFirstName);

            $manager = Manager::create([
                'name' => $fullName,
                'address' => $faker->address,
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
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $assignedRole = $faker->randomElement([$teacher_role, $coordinator_role]);
            $manager->assignRole($assignedRole);

            if ($assignedRole->name === 'teacher') {
                $manager->givePermissionTo([
                    $manager_list,
                    $manager_view,
                    $student_request_view,
                    $student_request_update,
                    $classroom_view,
                    $classroom_manage,
                    $learning_schedule_view,
                    $learning_schedule_create,
                    $learning_schedule_update,
                    $learning_schedule_delete,
                    $contact_book_view,
                    $contact_book_create,
                    $contact_book_update,
                    $contact_book_delete,
                ]);
            } else if ($assignedRole->name === 'coordinator') {
                $manager->givePermissionTo([
                    $manager_list,
                    $manager_view,
                    $meal_schedule_view,
                    $meal_schedule_create,
                    $meal_schedule_update,
                    $meal_schedule_delete,
                ]);
            }
        }
    }
}
