<?php

namespace App\Helpers;

trait CheckPermissions
{
    public function authorize($permissions)
    {
        return (auth()->user()->hasPermissionTo($permissions))?:abort(403);
    }
}
