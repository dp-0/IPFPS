<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Assigned Roles:</h2>
            <ul class="list-group">
                @foreach($user->roles as $role)
                    <li class="list-group-item">
                        {{ $role->name }}
                        <button class="btn btn-danger btn-sm float-right" wire:click="removeRole('{{ $role->id }}')">X</button>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h2>Add Roles:</h2>
            <select class="form-control" wire:model="selectedRoles">
                <option value="0">Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary mt-3" wire:click="assignRoles">Assign Roles</button>
        </div>
    </div>
</div>
