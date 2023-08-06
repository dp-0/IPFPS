<div>
    <div class="row">
        <div class="card w-100">
            <div class="card-header">
                Add Evidence Form
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Collected By</label>
                            <x-dropdown-with-image id="collectedBy" :items="$users" :selectedItem="$collected_by"
                                data-selected="collected_by" />
                            <x-input-error for="collected_by.id"></x-input-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Collection Date</label>
                            <input type="datetime-local"  class="form-control" name="collected_at"
                                wire:model="collected_at">
                                <x-input-error for="collected_at"></x-input-error>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Preserved By</label>
                            <x-dropdown-with-image id="preservedBy" :items="$users" :selectedItem="$preserved_by"
                                data-selected="preserved_by" />
                            <x-input-error for="preserved_by.id"></x-input-error>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Preserved Date</label>
                            <input type="datetime-local" class="form-control" name="preserved_at"
                                wire:model="preserved_at">
                            <x-input-error for="preserved_at"></x-input-error>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="evidenceTypeSelect">Select Evidence Type:</label>
                    <select class="form-control" id="evidenceTypeSelect" wire:model="evidenceType">
                        <option value="" disabled selected>Select an evidence type</option>
                        <option value="Document">Document</option>
                        <option value="Weapon">Weapon</option>
                        <option value="DNA_Sample">DNA Sample</option>
                        <option value="Other">Other</option>
                    </select>
                    <x-input-error for="evidenceType"></x-input-error>
                </div>
                <div class="form-group">
                    <label for="">Select File</label>
                    <x-input-filepond wire:model="files" multiple/>
                    <x-input-error for="files.*"></x-input-error>
                    <x-input-error for="files"></x-input-error>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description"class="form-control" cols="30" rows="10" wire:model="description"></textarea>
                    <x-input-error for="description"></x-input-error>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block" wire:click="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
