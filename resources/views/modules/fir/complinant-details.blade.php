<div>
    <div class="row">
        <div class="col-4">
            <div class="card border border-1 border-secondary">
                <div class="text-center">
                    <div class="card-body">
                        <img src="{{ asset($complinant->profile_photo_path) }}" data-fancybox data-caption="{{ $complinant->name }}"
                            data-download-filename="{{ $complinant->name }}" alt="{{ $complinant->name }}"
                            class="rounded-full h-40 w-40 object-cover mx-auto bg-primary">
                            <br>
                        <h5 class="card-title">{{ $complinant->name }}</h5>
                        <p class="cart-text">{{ $complinant->address }}</p>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Contact No</h6>
                                <span class="text-secondary">{{ $complinant->mobile_no }}</span>
                            </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
           <div class="card border border-1 border-secondary">
            <div class="card-body">
                <table class="table table-bordered  table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>S.N</th>
                            <th>Fir Number</th>
                            <th>Complain Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complains as $complain)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{$complain->title}}</td>
                                <td>{{$complain->getIncidentType->name}}</td>
                                <td><a href="{{route('admin.fir.complain.view',$complain->id)}}" class="btn btn-sm btn-primary">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           </div>
        </div>
    </div>
</div>
