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

    public function mount(){
        $this->permissions = PermissionList::getPermissionsWithModels();
    }
    public function render()
    {
        if($this->role->name=='admin'){
             to_route('admin.roles');
        }
        $this->authorize('read permissions');
        $rolePermisison = $this->role->permissions->map(fn ($value) => $value->name);
        $this->all = count($rolePermisison) == count($this->permissions->flatten());
        $userPermission = auth()->user()->getPermissionsViaRoles();
        return view('modules.user.role-permissions', [
            'rolePermissions' => $rolePermisison,
            'userPermissions' => $userPermission,
             'roleName' => $this->role->name
        ]);
    }

    public function toggleAll()
    {
        if($this->role->name=='admin'){
            return to_route('admin.roles');
        }
        $this->authorize('update permissions');
        $this->ensurePasswordIsConfirmed();
        if(!auth()->user()->hasAllPermissions($this->permissions->flatten())){
            abort(401);
        }
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
        if($this->role->name=='admin'){
            return to_route('admin.roles');
        }
        $this->authorize('update permissions');
        $hasPermission = $this->role->hasPermissionTo($permission);
        if(!auth()->user()->hasPermissionTo($permission)){
            abort(401);
        }
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
        if($this->role->name=='admin'){
            return to_route('admin.roles');
        }
        $this->authorize('update permissions');
        $modelPermission = $this->permissions[$model];
        $hasAllPermission = $this->role->hasAllPermissions($modelPermission);
        if(!auth()->user()->hasAllPermissions($modelPermission)){
            abort(403);
        }
        if ($hasAllPermission) {
            $this->role->revokePermissionTo($modelPermission);
        }
        if(!$hasAllPermission){
            $this->role->givePermissionTo($modelPermission);
        }
        $this->emit('save-'.$model);
    }
}
