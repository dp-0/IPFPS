<div>
    <div class="card">
        <div class="card-header flex justify-content-center">
            <strong>Suspect Information</strong>
            <button wire:click="$toggle('addSuspect')" class="btn btn-primary btn-sm ml-auto"> <i
                    class="fa fa-plus-circle"></i> Add Suspect </button>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Arrest Date</th>
                        <th>Released Date</th>
                        <th>Actions</th>
                    </tr>
                    @forelse ($suspects as $suspect)
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                <span>
                                    <img src="{{ asset($suspect->photo) }}" data-fancybox
                                        data-caption="{{ $suspect->name }}" data-download-filename="{{ $suspect->name }}"
                                        alt="{{ $suspect->name }}"
                                        class="rounded-full h-10 w-10 object-cover inline-block">
                                    {{ $suspect->name }}
                                </span>
                            </td>
                            <td>
                                {{ $suspect->age }}
                            </td>
                            <td>
                                {{ $suspect->gender }}
                            </td>
                            <td>
                                {{ $suspect->arrest_date }}
                            </td>
                            <td>
                                {{ $suspect->released_date }}
                            </td>

                            <td>
                                <a href="{{ route('admin.fir.suspect.profile', $suspect->id) }}"
                                    class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Profile</a>
                                <button wire:click="updateSuspect({{ $suspect->id }})"
                                    class="btn btn-primary btn-sm ml-auto"> <i class="fa fa-plus-circle"></i> Update
                                    Suspect </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-danger">No Record Found</td>
                        </tr>
                    @endforelse
                </thead>
            </table>
        </div>
    </div>

    @if ($addSuspect)
        <x-dialog-modal wire:model="addSuspect">
            <x-slot name="title">
                New Suspect Form
            </x-slot>
            <x-slot name="content">
                <x-label>Name</x-label>
                <x-input id="name" wire:model="name"></x-input>
                <x-input-error for="name"></x-input-error>

                <x-label>Age</x-label>
                <x-input id="age" wire:model="age"></x-input>
                <x-input-error for="age"></x-input-error>

                <x-label>Gender</x-label>
                <select id="gender" wire:model="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <x-input-error for="gender"></x-input-error>

                <x-label>Address</x-label>
                <x-input id="address" wire:model="address"></x-input>
                <x-input-error for="address"></x-input-error>

                <x-label>Nationality</x-label>
                <x-input id="nationality" wire:model="nationality"></x-input>
                <x-input-error for="nationality"></x-input-error>

                <x-label>Phone No</x-label>
                <x-input id="phone" wire:model="phone"></x-input>
                <x-input-error for="phone"></x-input-error>

                <x-label>Email</x-label>
                <x-input id="email" wire:model="email"></x-input>
                <x-input-error for="email"></x-input-error>

                <x-label>Description</x-label>
                <textarea name="description" id="description" class="form-control" cols="30" wire:model="description"></textarea>
                <x-input-error for="description"></x-input-error>

                <x-label>Photo</x-label>
                <x-input id="photo" wire:model="photo" type="file"></x-input>
                <x-input-error for="photo"></x-input-error>

                <x-label>Arrest Date</x-label>
                <x-input id="arrest_date" wire:model="arrest_date" type="date"></x-input>
                <x-input-error for="arrest_date"></x-input-error>

                <x-label>Released Date</x-label>
                <x-input id="released_date" wire:model="released_date" type="date"></x-input>
                <x-input-error for="released_date"></x-input-error>

                <x-label>Remarks</x-label>
                <textarea name="remarks" id="remarks" class="form-control" cols="30" wire:model="remarks"></textarea>
                <x-input-error for="remarks"></x-input-error>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    Cancel
                </x-secondary-button>
                <x-primary-button class="ml-2 btn-primary" wire:click="addSuspect" wire:loading.attr="disabled">
                    Add Suspect
                </x-primary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
    @if ($updateSuspect)
        <x-dialog-modal wire:model="updateSuspect">
            <x-slot name="title">
                Update Suspect Form
            </x-slot>

            <x-slot name="content">
                @if (!$u_suspect->arrest_date)
                    <x-label>Arrest Date</x-label>
                    <x-input id="arrest_date" wire:model="arrest_date" type="date"></x-input>
                    <x-input-error for="arrest_date"></x-input-error>
                @endif
                @if (!$u_suspect->released_date)
                    <x-label>Released Date</x-label>
                    <x-input id="released_date" wire:model="released_date" type="date"></x-input>
                    <x-input-error for="released_date"></x-input-error>
                @endif
                @if($u_suspect->arrest_date && $u_suspect->released_date)
                    <h6 class="text-danger">Arrest Date and Release Date already updated.</h6>
                @endif
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    Cancel
                </x-secondary-button>
                @if (!$u_suspect->arrest_date || !$u_suspect->released_date)
                    <x-primary-button class="ml-2 btn-primary" wire:click="update" wire:loading.attr="disabled">
                        Update
                    </x-primary-button>
                @endif
            </x-slot>

        </x-dialog-modal>
    @endif
</div>
