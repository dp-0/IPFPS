<?php

namespace App\Http\Modules\User;

use App\Helpers\CheckPermissions;
use App\Helpers\ConfirmsPasswords as HelpersConfirmsPasswords;
use App\Helpers\PermissionList;
use App\Models\Role;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class RolePermissions extends Component
{
    use CheckPermissions;
    use HelpersConfirmsPasswords;
    public $all;
    public Role $role;
    public $permissions;
    public function render()
    {
        $this->authorize('read permissions');
        $rolePermisison = $this->role->permissions->map(fn ($value) => $value->name);
        $this->permissions = PermissionList::getPermissionsWithModels();
        $this->all = count($rolePermisison) == count($this->permissions->flatten());
        return view('modules.user.role-permissions', ['rolePermissions' => $rolePermisison, 'roleName' => $this->role->name]);
    }

    public function toggleAll()
    {
        $this->authorize('update permissions');
        $this->ensurePasswordIsConfirmed();
        if ($this->all) {
            $this->role->syncPermissions([]);
        }
        if (!$this->all) {
            $this->role->syncPermissions(Permission::all());
        }
        $this->emit('saved-all');
    }

    public function togglePermission($permission)
    {
        $this->authorize('update permissions');
        $hasPermission = $this->role->hasPermissionTo($permission);
        if ($hasPermission) {
            $this->role->revokePermissionTo($permission);
        }
        if (!$hasPermission) {
            $this->role->givePermissionTo($permission);
        }
        $this->emit($permission);
    }

    public function toggleModelPermission($model)
    {
        $this->authorize('update permissions');
        $modelPermission = $this->permissions[$model];
        $hasAllPermission = $this->role->hasAllPermissions($modelPermission);
        if ($hasAllPermission) {
            $this->role->revokePermissionTo($modelPermission);
        }
        if(!$hasAllPermission){
            $this->role->givePermissionTo($modelPermission);
        }
        $this->emit('save-'.$model);
    }
}
