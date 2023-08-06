<div>
    <div class="row">
        <div class="col-2 ml-1 p-2">
            <button class="btn btn-primary btn-sm" wire:click="$toggle('addFirStatus')" value="true">Add
                Status</button>
        </div>
    </div>

    <x-table>
        <x-slot name="heading">
            <h2>Fir Status</h2>
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

                @forelse ($firStatus as $status)
                    <tr>
                        <td>
                            <x-sn :data="$firStatus" :$loop></x-sn>
                        </td>
                        <td>{{ $status->name }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                    wire:click="confirmFirStatusDeletion({{ $status->id }})" wire:loading.attr="disabled">
                                <i class="fa fa-trash"></i>
                                Delete</button>
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
            {{ $firStatus->links() }}
        </x-slot>
    </x-table>
    @if ($addFirStatus)
        <x-dialog-modal wire:model="addFirStatus">
            <x-slot name="title">
                Add Fir Status Form
            </x-slot>
            <x-slot name="content">
                <x-label>Incident Type</x-label>
                <x-input id="name" wire:model="name"></x-input>
                <x-input-error for="name"></x-input-error>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    Cancel
                </x-secondary-button>
                <x-primary-button class="ml-2 btn-primary" wire:click="addFirStatus" wire:loading.attr="disabled">
                    Add Fir Status
                </x-primary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
    <x-dialog-modal wire:model="deleteFirStatus">
        <x-slot name="title">
            {{ __('Delete Fir Status') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Fir Status? ') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('deleteFirStatus')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteFirStatus" wire:loading.attr="disabled">
                {{ __('Delete Fir Status') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
