<?php

namespace App\Http\Modules\User;

use App\Helpers\BaseComponent;
use App\Helpers\ConfirmsPasswords;
use App\Models\Role;


class Roles extends BaseComponent
{
    use ConfirmsPasswords;
    protected $model = Role::class;

    public $role_id;
    public $addRoles = false;
    public $newRoleName ='';

    public function render()
    {
        $this->authorize('read roles');
        $roles = $this->model::latest()->except('admin')->search($this->search)
        ->paginate($this->perPage);
        return view('modules.user.roles',compact('roles'));
    }

    public function delete($role_id){
        $this->role_id = $role_id;
        $this->ensurePasswordIsConfirmed();
        $this->authorize('delete roles');
        $this->validate();
        Role::find($role_id)->delete();
        $this->alertSuccess('Role Deleted Successfully');
    }

    public function addRole(){
        $this->authorize('create roles');
        $this->validate();
        Role::create(['name'=>$this->newRoleName,'guard_name'=>'web']);
        $this->alertSuccess('Role Created Successfully');
    }
    public function rules(){
        return [
                'role_id'=>'sometimes|required|exists:roles,id',
                'newRoleName'=>'sometimes|required|min:3|unique:roles,name'
            ];
    }

}
