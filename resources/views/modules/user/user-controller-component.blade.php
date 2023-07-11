<div>
    @can('create users')
        <div class="row">
            <div class="col-2 ml-1 p-2">
                <button class="btn btn-primary btn-sm" wire:click="$toggle('addUsers')" value="true">Add Users</button>
            </div>
        </div>
    @endcan
    <x-table>
        <x-slot name="heading">
            <h2>Users</h2>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <x-sn :data="$users" :$loop></x-sn>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @can('update users')
                                    <button class="btn btn-primary btn-sm" wire:click="update({{ $user->id }})"
                                        value="true"><i class="fa fa-edit"></i> Edit</button>
                                @endcan
                                @can('delete users')
                                    <button class="btn btn-danger btn-sm" wire:click="confirmUserDeletion({{$user->id}})" wire:loading.attr="disabled"><i class="fa fa-trash"></i>
                                        Delete</button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-rose-400">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <x-slot name="pagination">
            {{ $users->links() }}
        </x-slot>
    </x-table>
    <x-dialog-modal wire:model="addUsers">
        <x-slot name="title">
            Add User Form
        </x-slot>

        <x-slot name="content">
            <x-label>Name</x-label>
            <x-input id="userName" wire:model="user.name"></x-input>
            <x-input-error for="user.name"></x-input-error>
            <x-label>Email</x-label>
            <x-input type="email" id="userEmail" class="form-control" wire:model="user.email"></x-input>
            <x-input-error for="user.email"></x-input-error>
            <x-label>Type</x-label>
            <x-select wire:model="user.utype">
                <option value="">Select User Type</option>
                <option value="police">Police</option>
                <option value="forensic">Forensic</option>
            </x-select>
            <x-input-error for="user.utype"></x-input-error>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-primary-button class="ml-2 btn-primary" wire:click="addUser" wire:loading.attr="disabled">
                Add User
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>
    <x-dialog-modal wire:model="updateUsers">
        <x-slot name="title">
            Edit User Form
        </x-slot>
        <x-slot name="content">
            <x-label>Name</x-label>
            <x-input id="userName" wire:model="user.name"></x-input>
            <x-input-error for="user.name"></x-input-error>
            <x-label>Email</x-label>
            <x-input type="email" id="userEmail" class="form-control" wire:model="user.email"></x-input>
            <x-input-error for="user.email"></x-input-error>
            <x-label>Type</x-label>
            <x-select wire:model="user.utype">
                <option value="">Select User Type</option>
                <option value="police">Police</option>
                <option value="forensic">Forensic</option>
            </x-select>
            <x-input-error for="user.utype"></x-input-error>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-primary-button class="ml-2 btn-primary" wire:click="updateUser" wire:loading.attr="disabled">
                Save
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="deleteUsers">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this account? Once your account is deleted, all of its resources and data will be deleted. Please enter your password to confirm you would like to delete this account.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('deleteUsers')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
