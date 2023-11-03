<div>
    <x-table>
        <x-slot name="heading">
            <h2> Similar Firs</h2>
        </x-slot>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                   
                    <th>Fir Number</th>
                    <th>Matched Percentage</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table-striped">

                @foreach ($firs as $key => $value)
                    <tr>
                       <td>{{$value->case_number}}</td>
                       <td>{{$key}} %</td>
                       <td>
                        <a href="{{route('admin.fir.view',$value->id)}}" class="btn btn-sm btn-success">View</a>
                       </td>
                    
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <x-slot name="pagination">
           <span></span>
        </x-slot>
    </x-table>

</div>
