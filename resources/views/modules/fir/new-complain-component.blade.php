<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4>New Complain</h4>
        </div>
        <div class="card-body">
            <div class="col">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" wire:model="title" class="form-control">
                    <x-input-error for="title"></x-input-error>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="complain_by">Complainant</label>
                        <x-dropdown-with-image :items="$complinants" :selectedItem="$complinant"
                                               data-selected="complinant"/>
                        <x-input-error for="complinant.id"></x-input-error>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="incident_type_id">Incident Type</label>
                        <select class="form-control" id="incident_type_id" name="incident_type_id" required
                                wire:model="incident_type">
                            @foreach ($incidents as $incident)
                                <option value="{{ $incident->id }}">{{ $incident->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="incident_type"></x-input-error>
                    </div>
                </div>
                <div class="form-group" wire:ignore>
                    <label for="incident_details">Incident Details</label>
                    <div id="editor-container"></div>
                    <textarea name="incident_details" id="incident_details" style="display: none" wire:model="details"
                              required></textarea>
                </div>
                <x-input-error for="details"></x-input-error>


                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" wire:model="address" id="address" name="address" required></textarea>
                    <x-input-error for="address"></x-input-error>
                </div>


                <div class="form-group">
                    <label for="incident_date">Incident Date</label>
                    <input type="date" class="form-control" wire:model="incident_date" id="incident_date"
                           name="incident_date" required>
                    <x-input-error for="incident_date"></x-input-error>
                </div>

                <button type="submit" class="btn btn-primary" wire:click="newComplain">Create</button>

            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    'color': []
                }, {
                    'background': []
                }],
            ];

            var quill = new Quill('#editor-container', {
                theme: 'snow',
                modules: {
                    toolbar: toolbarOptions
                }
            });
            quill.on('text-change', function () {
                @this.
                set('details', quill.root.innerHTML);
            });
        </script>
    @endpush
</div>
