<div>
    <div class="row">
        <div class="col-2 ml-1 p-2">
            <a href="{{route('admin.fir.complain.new')}}" class="btn btn-primary btn-sm"  value="true">Add
                Complain</a>
        </div>
    </div>

    <x-table>
        <x-slot name="heading">
            <h2>Complains</h2>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>S.N</th>
                    <th>Complainant</th>
                    <th>Incident Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table-striped">

                @forelse ($complains as $complain)
                    <tr>
                        <td>
                            <x-sn :data="$complains" :$loop></x-sn>
                        </td>
                        <td>{{ $complain->getComplainBy->name }}</td>
                        <td>{{ $complain->getIncidentType->name }}</td>
                        <td>{{ $complain->getStatus->name }}</td>
                        <td>
                            <a href="{{route('admin.fir.complain.view', $complain->id)}}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-rose-400">No Record Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <x-slot name="pagination">
            {{ $complains->links() }}
        </x-slot>
    </x-table>
</div>
