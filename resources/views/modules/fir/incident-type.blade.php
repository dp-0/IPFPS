<div>
    <div class="row">
        <div class="col-2 ml-1 p-2">
            <button class="btn btn-primary btn-sm" wire:click="$toggle('addIncidentType')" value="true">Add
                Incident Type</button>
        </div>
    </div>

    <x-table>
        <x-slot name="heading">
            <h2>Incident Types</h2>
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

                    @forelse ($incidentTypes as $incident)
                        <tr>
                            <td>
                                <x-sn :data="$incidentTypes" :$loop></x-sn>
                            </td>
                            <td>{{ $incident->name }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm"
                                    wire:click="confirmIncidentTypeDeletion({{ $incident->id }})" wire:loading.attr="disabled">
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
            {{ $incidentTypes->links() }}
        </x-slot>
    </x-table>
    @if ($addIncidentType)
        <x-dialog-modal wire:model="addIncidentType">
            <x-slot name="title">
                Add Incident Type Form
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
                <x-primary-button class="ml-2 btn-primary" wire:click="addIncidentType" wire:loading.attr="disabled">
                    Add Incident Type
                </x-primary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
    <x-dialog-modal wire:model="deleteIncidentType">
        <x-slot name="title">
            {{ __('Delete Incident type') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Incident Type? ') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('deleteIncidentType')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteIncidentType" wire:loading.attr="disabled">
                {{ __('Delete Incident Type') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
