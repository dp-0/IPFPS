<?php

namespace Database\Seeders;

use App\Helpers\PermissionList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = PermissionList::getPermissions();

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }
    }
}
