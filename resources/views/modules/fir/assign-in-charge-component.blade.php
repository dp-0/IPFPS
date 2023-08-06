<div>
    <div class="card">
        <div class="card-header flex justify-content-between">
            <span> <strong>Officer Information</strong></span>
            <span class="row w-50">
                <div class="col-8">
                    <x-dropdown-with-image :items="$users" :selectedItem="$new_officer" data-selected="new_officer" />
                </div>
                <div class="col-4">
                    <button wire:click="addInCharge" class="btn btn-primary btn-sm ml-auto"> <i
                            class="fa fa-plus-circle"></i> Add InCharge</button>
                </div>
            </span>

        </div>
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    @forelse ($officers as $officer)
                   
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $officer->user->name }}
                            </td>
                            <td>
                                {{ $officer->user->email }}
                            </td>
                            <td>
                                {{$officer->start_date}}
                            </td>
                            <td>
                                {{ $officer->end_date }}
                            </td>
                        </tr>
                    @empty
                        <td colspan="5" class="text-center text-danger">No Record Found</td>
                    @endforelse
                </thead>
            </table>

        </div>
        <div class="card-footer">
            {{$officers->links()}}
        </div>
    </div>
</div>
