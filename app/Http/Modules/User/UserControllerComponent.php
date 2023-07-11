<?php

namespace App\Http\Modules\User;

use Illuminate\Support\Str;
use App\Helpers\BaseComponent;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserControllerComponent extends BaseComponent
{
    protected $model = User::class;

  
    public $addUsers = false;
    public $updateUsers = false;
    public $deleteUsers = false;
    public $user_id;
    public $user = [];

    public function updated($propertyName){
        parent::updated($propertyName);
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        $this->authorize('read users');
        $users = $this->model::latest()->search($this->search)->where('id','<>',1)
            ->paginate($this->perPage);
        return view('modules.user.user-controller-component', ['users' => $users]);
    }

    public function addUser()
    {
        $this->authorize('create users');
        $rules = $this->rules();
        unset($rules['user_id']);
        $validatedData =  $this->validate($rules);
        $password = Str::password();
        $validatedData['user']['password'] = bcrypt($password);
        $user = User::create($validatedData['user']);
        $this->alert('success','User created successfully');
        $this->user = [];
        $this->addUsers = false;
    }
    public function update($userId)
    {
        $user = User::findorfail($userId);
        $this->user = [
            'utype' => $user->utype,
            'email' => $user->email,
            'name' => $user->name
        ];
        $this->user_id = $user->id;
        $this->updateUsers = true;
    }
    public function updateUser()
    {
        $this->authorize('update users');
        $validatedData = $this->validate();
        $user = User::findorfail($this->user_id);
        $user->update($validatedData['user']);
        $this->alert('success','User Updated successfully');
        $this->user = [];
        $this->updateUsers = false;
    }

    public function confirmUserDeletion($user_id){
       $this->user_id = $user_id;
       $this->deleteUsers = true;
    }
    public function deleteUser(){
        $validated = Validator::make(['user_id'=>$this->user_id], ['user_id' => 'required|exists:users,id'])->validate();
        $user = User::find($validated['user_id']);
        $user->delete();
        $this->alert('success','User Deleted Successfully');
        $this->erase();
    }

   
    public function rules()
    {
        return [
            'user.name' => 'required|min:3',
            'user.email' => 'required|email|unique:users,email,'.$this->user_id,
            'user.utype' => 'required|in:admin,police,forensic',
            'user_id' => 'required|exists:users,id'
        ];
    }

    protected $validationAttributes = [
        'user.name' => 'Name',
        'user.email' => 'Email',
        'user.utype' => 'Type',
        'user.user_id' => 'User Id'
    ];
}
