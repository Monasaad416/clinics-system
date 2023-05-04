<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['superadmin','admin','reception','marketing','financial','customer_service','nursing','doctor','client'];
        foreach ($roles as $role) {
            Role::create(
                [
                    'name' => $role,
                ],
            );
        }
    }
}
