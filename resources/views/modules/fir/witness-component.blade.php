<div>
    <div class="card">
        <div class="card-header flex jutify-content-center">
            <strong>Witness Information</strong> 
            <button wire:click="$toggle('addWitness')" class="btn btn-primary btn-sm ml-auto"> <i class="fa fa-plus-circle"></i> Add Witness </button>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone No</th>
                        <th>Statement</th>
                    </tr>
                    @forelse ($witness as $witnes)
                        <tr>
                            <td>
                                {{$loop->index + 1}}
                            </td>
                            <td>
                                {{$witnes->name}}
                            </td>
                            <td>
                                {{$witnes->address}}
                            </td>
                            <td>
                                {{($witnes->phone_no)?:'N/A'}}
                            </td>
                            <td>
                                {{$witnes->statement}}
                            </td>
                        </tr>
                        @empty
                            <td colspan="5" class="text-center text-danger">No Record Found</td>
                    @endforelse
                </thead>
            </table>
        </div>
    </div>
    @if ($addWitness)
    <x-dialog-modal wire:model="addWitness">
        <x-slot name="title">
            New Witness Form
        </x-slot>
        <x-slot name="content">
            <x-label>Name</x-label>
            <x-input id="name" wire:model="name"></x-input>
            <x-input-error for="name"></x-input-error>
            <x-label>Address</x-label>
            <x-input id="address" wire:model="address"></x-input>
            <x-input-error for="address"></x-input-error>
            <x-label>Contact No</x-label>
            <x-input id="contact_number" wire:model="contact_number"></x-input>
            <x-input-error for="contact_number"></x-input-error>
            <x-label>Statement</x-label>
          <textarea name="statement" id="statement" class="form-control" cols="30"  wire:model="statement"></textarea>
            <x-input-error for="statement"></x-input-error>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>
            <x-primary-button class="ml-2 btn-primary" wire:click="addWitness" wire:loading.attr="disabled">
                Add Incident Type
            </x-primary-button>
        </x-slot>
    </x-dialog-modal>
@endif
</div>
