<?php

namespace Database\Seeders;

use App\Helpers\PermissionList;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $adminRole = Role::create(['name'=>'admin']);
       $permissions = PermissionList::getPermissions();
       $adminRole->syncPermissions($permissions);

    //    Role::factory(10)->create();

    }
}
