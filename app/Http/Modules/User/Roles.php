<?php

namespace App\Http\Modules\User;

use App\Helpers\BaseComponent;
use App\Helpers\ConfirmsPasswords;
use App\Models\Role;
use PDO;

class Roles extends BaseComponent
{
    use ConfirmsPasswords;
    protected $model = Role::class;

    public $role_id;
    public $addRoles = false;
    public $newRoleName = '';

    public function updated($propertyName)
    {
        parent::updated($propertyName);
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $this->authorize('read roles');
        $roles = $this->model::latest()->search($this->search)->except('admin')
            ->paginate($this->perPage);
        return view('modules.user.roles', compact('roles'));
    }

    public function delete($role_id)
    {
        $this->role_id = $role_id;
        $this->ensurePasswordIsConfirmed();
        $this->authorize('delete roles');
        $this->validate(['role_id' => 'required|exists:roles,id']);
        Role::find($role_id)->delete();
        $this->alert('success', 'Role Deleted Successfully');
        $this->erase();
    }

    public function addRole()
    {
        $this->authorize('create roles');
        $this->validate(['newRoleName' => 'required|min:3|unique:roles,name']);
        Role::create(['name' => $this->newRoleName, 'guard_name' => 'web']);
        $this->alert('success', 'Role Created Successfully');
        $this->erase();
    }
    public function rules()
    {
        return [
            'role_id' => 'required|exists:roles,id',
            'newRoleName' => 'required|min:3|unique:roles,name'
        ];
    }
}
