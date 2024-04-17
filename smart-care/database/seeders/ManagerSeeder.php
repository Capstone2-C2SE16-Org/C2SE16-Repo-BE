<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Manager;
use Illuminate\Support\Str;
//use Database\Factories\ManagerFactory;
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

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            $manager_create,
            $manager_list,
            $manager_update,
            $manager_view,
            $manager_delete
        ]);

        $admin = Manager::create([
            'name' => 'Admin',
            'address' => 'Da Nang',
            'day_of_birth' => '2000-01-01',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'gender' => '1',
            'profile_image' => 'img',
            'phone_number' => '0905123434',
            'username' => 'admin',
            'password' => Hash::make('password'), // You can set your desired default password here
            'is_enable' => 1, // 90% chance of being true
            'remember_token' => Str::random(10),
        ]);

        $admin->syncRoles($admin_role);
        $admin->givePermissionTo([
            $manager_create,
            $manager_list,
            $manager_update,
            $manager_view,
            $manager_delete
        ]);

        $teacher_role = Role::create(['name' => 'teacher']);
        $teacher_role->givePermissionTo([
            $manager_list,
            $manager_view,
        ]);

        $coordinator_role = Role::create(['name' => 'coordinator']);
        $coordinator_role->givePermissionTo([
            $manager_list,
            $manager_view,
        ]);


        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $manager = Manager::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'day_of_birth' => $faker->date,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'gender' => rand(0, 1),
                'profile_image' => $faker->imageUrl(),
                'phone_number' => $faker->phoneNumber,
                'username' => $faker->userName,
                'password' => Hash::make('password'), // You can set your desired default password here
                'is_enable' => $faker->boolean(90), // 90% chance of being true
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $assignedRole = $faker->randomElement([$teacher_role, $coordinator_role]);
            $manager->assignRole($assignedRole);
            $manager->givePermissionTo([
                $manager_list,
                $manager_view,
            ]);
        }
    }
}
