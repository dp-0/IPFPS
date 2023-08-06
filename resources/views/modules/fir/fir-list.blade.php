<div>
    <div class="row">
        <div class="col-2 ml-1 p-2">
            <a href="{{route('admin.fir.new')}}" class="btn btn-primary btn-sm" value="true">Register Fir</a>
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
                        <th>Incident Type</th>
                        <th>Case No</th>
                        <th>Complain By</th>
                        <th>Reported Date</th>
                        <th>Investigation Date</th>
                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-striped">

                    @forelse ($firs as $fir)
                        <tr>
                            <td>
                                <x-sn :data="$firs" :$loop></x-sn>
                            </td>
                            <td>{{ $fir->getIncidentType->name }}</td>
                            <td>{{$fir->case_number}}</td>
                            <td>{{ $fir->getComplainBy->name }}</td>
                            <td>{{$fir->reported_at}}</td>
                            <td>{{($fir->investigation_start_date)?:'N/A'}}</td>
                            <td>
                                <a href="{{route('admin.fir.view',$fir->id)}}" class="btn btn-sm btn-success">Details</a>
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
            {{ $firs->links() }}
        </x-slot>
    </x-table>
    
</div>
