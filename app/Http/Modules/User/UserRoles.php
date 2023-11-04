<?php

namespace App\Http\Modules\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class UserRoles extends Component
{
    public User $user;
    public $selectedRoles = [];
    public $updeted = false;
    public function render()
    {
//         $permissions = $this->user->getAllPermissions();
// dd($permissions);
        $this->updeted = false;
        $roles = Role::all();
        $assignedRoles = $this->user->roles->pluck('id')->toArray();

        return view('modules.user.user-roles', [
            'roles' => $roles,
            'assignedRoles' => $assignedRoles,
        ]);
    }


    public function assignRoles()
    {
        $existingRoles = $this->user->roles->pluck('id')->toArray();
        $newRoles = (array) $this->selectedRoles;
        $rolesToAssign = array_merge($existingRoles, $newRoles);

        $this->user->syncRoles($rolesToAssign);
        $this->selectedRoles = [];
        $this->dispatchBrowserEvent('toast.success', [
            'tite' => "Role Added",
            'message' => "Role added Successfully",
            'type' => 'success'
        ]);
    }
    public function removeRole($roleId)
    {
        $this->user->roles()->detach($roleId);
        $this->dispatchBrowserEvent('toast.success', [
            'tite' => "Delete",
            'message' => "Role Deleted Successfully",
            'type' => "info"
        ]);
        $this->updeted = true;
    }
}
