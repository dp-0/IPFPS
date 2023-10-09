<div>
    <x-card>
        <x-slot name="cardHeading">
            <b>Search Image</b>
        </x-slot>
        <div>
            @if ($ImageModel)
                <div class="row">
                    <div class="col-md-3 col-12">
                        <img src="{{ asset($ImageModel->input_image_path) }}" alt="{{ $ImageModel->uuid }}"
                            class="img-fluid img-thumbnail rounded mx-auto d-block">
                        <hr>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" wire:model="files" class="custom-file-input" id="inputGroupFile02"
                                    aria-describedby="inputGroupFileAddon02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                <x-input-error for="files"></x-input-error>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-12">
                        <div class="card rounded">
                            <div class="card-header">

                                <div class="progress">
                                    <div class="progress-bar rounded-full" role="progressbar"
                                        style="width: {{ number_format((float) $ImageModel->search_percentage, 2, '.', '') }}%"
                                        aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                                        Searching
                                        ({{ number_format((float) $ImageModel->search_percentage, 2, '.', '') }}%)
                                        Completed
                                    </div>
                                </div>


                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if (isset($ImageModel->result))
                                        @if ($ImageModel->status == 'pending')
                                            <div class="col-md-4 mb-1" wire:model="loading">
                                                <div class="card">
                                                    <div class="animate-pulse">
                                                        <div
                                                            class="card-img-top bg-gray-300 rounded mx-auto d-block object-cover h-48 w-full">
                                                            <div class="flex flex-col items-center justify-center">
                                                                <span class="text-gray-600">Searching...</span>
                                                                <div class="spinner-border" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title bg-gray-300 h-6 w-2/3 mb-4"></h5>
                                                            <a href="#"
                                                                class="btn btn-sm btn-primary bg-blue-500 h-8 w-32"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @foreach (array_reverse(json_decode($ImageModel->result)) as $key => $value)
                                            <div class="col-md-4 mb-1" wire:model="loading">
                                                <div class="card">
                                                    <img data-fancybox data-caption="{{ $ImageModel->uuid }}"
                                                        data-download-filename="{{ $ImageModel->uuid }}"
                                                        src="{{ asset($value->searched_path) }}"
                                                        class="card-img-top img-thumbnail rounded mx-auto d-block object-cover"
                                                        loading="lazy" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Matched:
                                                            {{ number_format((float) $value->match_percentage, 2, '.', '') }}
                                                            %
                                                        </h5>
                                                        <a href="{{ route('search.image.detail', ['search' => base64_encode($value->searched_path), 'uuid' => base64_encode($ImageModel->uuid)]) }}"
                                                            class="btn btn-sm btn-primary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-4 mb-1 border border-1" wire:model="loading">
                                            <div class="card">
                                                <div class="animate-pulse">
                                                    <div
                                                        class="card-img-top bg-gray-300 rounded mx-auto d-block object-cover h-48 w-full">
                                                        <div class="flex flex-col items-center justify-center">
                                                            <span class="text-gray-600">Searching...</span>
                                                            <div class="spinner-border" role="status">
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title bg-gray-300 h-6 w-2/3 mb-4"></h5>
                                                        <a href="#"
                                                            class="btn btn-sm btn-primary bg-blue-500 h-8 w-32"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" wire:model="files" class="custom-file-input" id="inputGroupFile01"
                            aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        <x-input-error for="files"></x-input-error>
                    </div>
                </div>
            @endif
        </div>
        <x-slot name="cardFooter">
        </x-slot>
    </x-card>
    @push('scripts')
        <script>
            var intId= setInterval(() => {
                window.livewire.emit('update');
            }, 5000);
        </script>
        
    @endpush
</div>
