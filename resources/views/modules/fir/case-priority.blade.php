<div>
    <div class="row">
        <div class="col-2 ml-1 p-2">
            <button class="btn btn-primary btn-sm" wire:click="$toggle('addCasePriority')" value="true">Add
                Case Priority</button>
        </div>
    </div>

    <x-table>
        <x-slot name="heading">
            <h2> Case Priorities</h2>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Priority</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table-striped">

                @forelse ($casePriorities as $priority)
                    <tr>
                        <td>
                            <x-sn :data="$casePriorities" :$loop></x-sn>
                        </td>
                        <td>{{ $priority->name }}</td>
                        <td>{{$priority->priority}}</td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                    wire:click="confirmCasePriorityDeletion({{ $priority->id }})" wire:loading.attr="disabled">
                                <i class="fa fa-trash"></i>
                                Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-rose-400">No Record Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <x-slot name="pagination">
            {{ $casePriorities->links() }}
        </x-slot>
    </x-table>
    @if ($addCasePriority)
        <x-dialog-modal wire:model="addCasePriority">
            <x-slot name="title">
                 Case Priority Create Form
            </x-slot>
            <x-slot name="content">
                <x-label>Priority Name</x-label>
                <x-input id="name" wire:model="state.name"></x-input>
                <x-input-error for="state.name"></x-input-error>

                <x-label>Case Priority</x-label>
                <x-input id="priority" wire:model="state.priority"></x-input>
                <x-input-error for="state.priority"></x-input-error>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    Cancel
                </x-secondary-button>
                <x-primary-button class="ml-2 btn-primary" wire:click="addCasePriority" wire:loading.attr="disabled">
                    Add Case Priority
                </x-primary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
    <x-dialog-modal wire:model="deleteCasePriority">
        <x-slot name="title">
            {{ __('Delete Case Priority') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Case Priority? ') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('deleteCasePriority')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteCasePriority" wire:loading.attr="disabled">
                {{ __('Delete Case Priority') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
