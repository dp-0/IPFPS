<div>
    <div class="row">
        <div class="col-2 ml-1 p-2">
            <button class="btn btn-primary btn-sm" wire:click="$toggle('addComplainants')" value="true">Add
                Complainant</button>
        </div>
    </div>

    <x-table>
        <x-slot name="heading">
            <h2>Complainants</h2>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>I.D</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact No</th>

                    </tr>
                </thead>
                <tbody class="table-striped">

                    @forelse ($complainants as $comp)
                        <tr>
                            <td>
                                <x-sn :data="$complainants" :$loop></x-sn>
                            </td>
                            <td>
                                <span class="">
                                    <img src="{{ asset($comp->profile_photo_path) }}" data-fancybox
                                        data-caption="{{ $comp->name }}" data-download-filename="{{ $comp->name }}"
                                        alt="{{ $comp->name }}"
                                        class="rounded-full h-10 w-10 object-cover inline-block">
                                    {{ $comp->name }}
                                </span>
                            </td>

                            <td>{{ $comp->address }}</td>
                            <td>{{ $comp->mobile_no }}</td>

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
            {{ $complainants->links() }}
        </x-slot>
    </x-table>
    @if ($addComplainants)
        <x-dialog-modal wire:model="addComplainants">
            <x-slot name="title">
                Add Complainants Form
            </x-slot>
            <x-slot name="content">
                <x-image-upload :photo="$complainant['photo']" wire:model="complainant.photo" />
                <x-input-error for="complainant.photo"></x-input-error>
                <x-label>Name</x-label>
                <x-input id="complainantName" wire:model="complainant.name"></x-input>
                <x-input-error for="complainant.name"></x-input-error>
                <x-label>Address</x-label>
                <x-input type="address" id="complainantAddress" class="form-control" wire:model="complainant.address">
                </x-input>
                <x-input-error for="complainant.address"></x-input-error>
                <x-label>Mobile No</x-label>
                <x-input type="mobile" id="complainantMobileNo" class="form-control"
                    wire:model="complainant.mobile_no"></x-input>
                <x-input-error for="complainant.mobile_no"></x-input-error>

            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    Cancel
                </x-secondary-button>
                <x-primary-button class="ml-2 btn-primary" wire:click="addComplainant" wire:loading.attr="disabled">
                    Add Complainant
                </x-primary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
    <x-dialog-modal wire:model="deleteComplainants">
        <x-slot name="title">
            {{ __('Delete Complainant') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Complainant? ') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('deleteComplainants')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteComplainant" wire:loading.attr="disabled">
                {{ __('Delete Complainant') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
