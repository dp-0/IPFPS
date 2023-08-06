<div>
    <div class="row">
        <div class="col-4">
            <div class="card border border-1 border-secondary">
                <div class="text-center">
                    <div class="card-body">
                        <img src="{{ asset($suspect->photo) }}" data-fancybox data-caption="{{ $suspect->name }}"
                            data-download-filename="{{ $suspect->name }}" alt="{{ $suspect->name }}"
                            class="rounded-full h-40 w-40 object-cover mx-auto bg-primary">
                            <br>
                        <h5 class="card-title">{{ $suspect->name }}</h5>
                        <p class="cart-text">{{ $suspect->address }}</p>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Contact No</h6>
                                <span class="text-secondary">{{ $suspect->phone }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Age</h6>
                                <span class="text-secondary">{{ $suspect->age }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Gender</h6>
                                <span class="text-secondary">{{ $suspect->gender }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Nationality</h6>
                                <span class="text-secondary">{{ $suspect->nationality }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Email</h6>
                                <span class="text-secondary">{{ $suspect->email }}</span>
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
                            <th>Case Number</th>
                            <th>Complinant</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suspect->getFirs as $fir)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{$fir->case_number}}</td>
                                <td>{{$fir->getComplainBy->name}}</td>
                                <td><a href="{{route('admin.fir.view',$fir->id)}}" class="btn btn-sm btn-primary">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           </div>
        </div>
    </div>
</div>
