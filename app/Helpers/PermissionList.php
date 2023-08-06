<?php

namespace App\Helpers;

class PermissionList
{
    private $others = [];

    private $models = [
        'users',
        'roles',
        'permissions',
        'complainants',
        'incident type'
    ];

    public static function getPermissions()
    {
        return collect((new self())->generatePermissionsWithModels())->flatten()->all();
    }

    public static function getPermissionsWithModels(){
        return collect((new self())->generatePermissionsWithModels());
    }

    private function generatePermissionsWithModels(): array
    {
        $permissions = [];

        foreach ($this->models as $model) {
            $permissions[$model] = [
                'read ' . $model,
                'create ' . $model,
                'update ' . $model,
                'delete ' . $model,
            ];
        }

        foreach ($this->others as $otherPermission) {
            $permissions['others'][] = $otherPermission;
        }

        return $permissions;
    }
}
