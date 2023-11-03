<div>
    <div class="card">
        <div class="card-header flex jutify-content-center">
            <strong>Evidences</strong>
            <a href="{{ route('admin.fir.evidence.add', $fir_id) }}" class="d-print-none btn btn-primary btn-sm ml-auto">
                <i class="fa fa-plus-circle"></i> Add Evidence
            </a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Collected By</th>
                        <th>Collected At</th>
                        <th class="no-print">Action</th>
                    </tr>
                    @forelse ($evidences as $evidence)
                        <tr>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>
                                {{ $evidence->short_description }}
                            </td>
                            <td>
                                {{ $evidence->type }}
                            </td>
                            <td>
                                {{ $evidence->collectedBy->name }}
                            </td>
                            <td>
                                {{ $evidence->collected_at }}
                            </td>
                            <td class="d-print-none">
                                <button class="btn btn-primary btn-sm" wire:click="viewEvidence({{$evidence->id}})"
                                    value="true"><i class="fa fa-eye">View</i></button>
                            </td>
                        </tr>
                    @empty
                        <td colspan="6" class="text-center text-danger">No Record Found</td>
                    @endforelse
                </thead>
            </table>
        </div>
    </div>
    @if ($viewEvidence)
        <x-dialog-modal wire:model="viewEvidence">
            <x-slot name="title">
                Evidence Details
            </x-slot>
            <x-slot name="content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Fir Id: 
                            </th>
                            <td>
                                {{ $fir_id }}
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
    
                            <th>Type</th>
                            <td>{{$modal_evidence->type}}</td>
                        </tr>
                        <tr>
                            <th>Collected By: </th>
                            <td>{{$modal_evidence->collectedBy->name}}</td>
                        </tr>
                        <tr>
                            <th>Collected At: </th>
                            <td>{{$modal_evidence->collected_at}}</td>
                        </tr>
                        <tr>
                            <th>Preserved By: </th>
                            <td>{{$modal_evidence->preservedBy->name}}</td>
                        </tr>
                        <tr>
                            <th>Preserved At: </th>
                            <td>{{$modal_evidence->preserved_at}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$modal_evidence->description}}</td>
                        </tr>
                        <tr>
                            <th>Files</th>
                            <td>
                                <ul class="list-group list-group-flush">
                                 @php
                                     $files = json_decode($evidence->attachment_path, true);
                                     unset($files['key']);
                                     unset($files['iv']);
                                     
                                 @endphp   
                            @foreach ($files as $index=>$file)
                                <li class="list-group-item list-group-item-action"><a href="{{route('download',['hash'=>$file['hash'],'id'=>$modal_evidence->id])}}" target="_blank" rel="noopener noreferrer">Document {{$loop->index +1}}</a></li>
                            @endforeach

                        </ul>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    Cancel
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
