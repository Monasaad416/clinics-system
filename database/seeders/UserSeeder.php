<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Salary;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '+123456',
            'password' => Hash::make('12345678'),
            'department_id' => 7 ,
            'roles_name' => ["superadmin"],
            'branch_id' => 1,
    ]);

            $user->salary()->create([
            'salariable_type' => 'App\Models\User',
            'salariable_id' => '1',
            'branch_id' => 1,
            'amount' => '1000',
            'details' => 'راتب'
        ]);

        $role = Role::create(['name' => 'superadmin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);



    }
}
