<div>
    @can('create roles')
        <div class="row">
            <div class="col-2 ml-1 p-2">
                <button class="btn btn-primary btn-sm" wire:click="$toggle('addRoles')" value="true">Add Roles</button>
            </div>
        </div>
    @endcan
    <x-table>
        <x-slot name="heading">
            <h2>Roles</h2>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        @can(['read permissions', 'delete roles'])
                            <th>Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @can('read permissions')
                                    <a href="{{ route('admin.roles_permissions', $role->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fa fa-user-cog"></i>
                                        Permissions</a>
                                @endcan
                                @can('delete roles')
                                    <x-confirms-password wire:then="delete({{ $role->id }})"
                                        wire:loading.attr="disabled">
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </x-confirms-password>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-slot name="pagination">{{ $roles->links() }}</x-slot>
    </x-table>
    <x-dialog-modal wire:model="addRoles">
        <x-slot name="title">
            Add Role Form
        </x-slot>

        <x-slot name="content">
            <x-label>Role Name</x-label>
            <x-input id="newRoleName" class="form-control" wire:model="newRoleName"></x-input>
            <x-input-error for="newRoleName"></x-input-error>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('addRoles')" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="addRole" wire:loading.attr="disabled">
                Add Role
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
