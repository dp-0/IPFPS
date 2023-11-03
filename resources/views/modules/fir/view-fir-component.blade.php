<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex justify-content-between">
                <strong>Fir Information</strong>
                <strong>
                    <a href="{{ route('fir.similarity', $fir->id) }}" class="no-print btn btn-secondary btn-sm">Similar
                        Cases</a>
                    @if ($fir->getStatus->name != 'Closed')
                        <button wire:click="close()" class="btn btn-sm btn-danger">Close</button>
                    @endif
                </strong>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Case Number: </strong>{{ $fir->case_number }}
                        <p>
                            Status: {{ $fir->getStatus->name }}
                        </p>
                    </li>
                    <li class="list-group-item">
                        <h5><strong>Incident Information</strong></h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Complain By:</th>
                                    <td>
                                        <div class="row flex align-items-center">
                                            <img src="{{ asset($fir->getComplainBy->profile_photo_path) }}"
                                                data-fancybox data-caption="{{ $fir->getComplainBy->name }}"
                                                data-download-filename="{{ $fir->getComplainBy->name }}"
                                                alt="{{ $fir->getComplainBy->name }}"
                                                class="rounded-full h-10 w-10 object-cover inline-block">
                                            <strong class="pl-2"> {{ $fir->getComplainBy->name }}</strong>
                                        </div>
                                    </td>
                                </tr>

                            </thead>

                            <tr>
                                <th>Address:</th>
                                <td>{{ $fir->address }} @if ($fir->latitude && $fir->longitude)
                                        ( {{ $fir->latitude }}, {{ $fir->longitude }})
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Type:</th>
                                <td>
                                    {{ $fir->getIncidentType->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>Details:</th>
                                <td>
                                    {{ $fir->incident_details }}
                                </td>
                            </tr>
                            <tr>
                                <th>Date:</th>
                                <td>
                                    {{ $fir->incident_date }}
                                </td>
                            </tr>
                        </table>
                    </li>

                    <li class="list-group-item">
                        <h5><strong>Investigation Details</strong></h5>
                        <table class="table table-responsive">
                            <thead>
                                <th width="15%">Warrant N.O:</th>
                                <td width="85%">{{ $fir->warrant_number }}</td>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Reported Date:</th>
                                    <td>{{ $fir->reported_at }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date:</th>
                                    <td>{{ $fir->investigation_start_date ?: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Closed Date:</th>
                                    <td>{{ $fir->investigation_end_date ?: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Priority:</th>
                                    <td>{{ $fir->getPriority->name }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $fir->getStatus->name }}</td>
                                </tr>
                                <tr>
                                    <th>Register By:</th>
                                    <td>{{ $fir->getRegisterBy->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                    <li class="list-group-item">
                        <div>
                            @livewire('fir.evidence-component', ['fir_id' => $fir->id])
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            @livewire('fir.witness-component', ['fir' => $fir->id])
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            @livewire('fir.suspect-component', ['fir_id' => $fir->id])
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div>
                            @livewire('fir.assign-in-charge-component', ['fir_id' => $fir->id])
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
