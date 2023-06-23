<div>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-striped">
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{route('admin.roles_permissions',$role->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-user-cog"></i>
                                    Permissions</a>
                                <x-confirms-password wire:then="delete({{ $role->id }})" wire:loading.attr="disabled">
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        Delete</button>
                                </x-confirms-password>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-slot name="pagination">{{ $roles->links() }}</x-slot>
    </x-table>
</div>
