<div>
    <form wire:submit.prevent="complainNumber">
        <div class="input-group"></div>
        <div class="input-group">
            <input type="text" name="complain_number" class="form-control bg-light small"
                wire:model.defer="complainNumber" placeholder="Enter Complain Number" autocomplete="complain_number"
                aria-label="Search" aria-describedby="basic-addon2">

            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
        <x-input-error for="complainNumber"></x-input-error>
    </form>
    <br>
    @if ($complain)
    <div class="row">
        <div class="col-4">
           
                <div class="card">
                    <div class="card-header">
                        <h4>Complain Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">

                            <div class="form-group">
                                Title: <input type="text" class="form-control" readonly value="{{ $complain->title }}">
                            </div>
                            <div class="form-group">
                                Complain By: <input type="text" class="form-control" readonly
                                    value="{{ $complain->getComplainBy->name }}">
                            </div>
                            <div class="form-group">
                                Address :
                                <textarea class="form-control" readonly>{{ $complain->address }}</textarea>
                            </div>
                            <div class="form-group">
                                Incident Type: <select class="form-control" readonly="">
                                    <option value="">{{ $complain->getIncidentType->name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                Register By: <input type="text" value="{{ $complain->getRegisterBy->name }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                Incident Date : <input type="date" class="form-control" readonly
                                    value="{{ now()->parse($complain->incident_date)->format('Y-m-d') }}">
                            </div>
                            <div class="form-group">
                                Reported Date :
                                <input type="date" class="form-control" readonly value="{{now()->parse($complain->reported_at)->format('Y-m-d')  }}">
                            </div>
                        </div>
                    </div>
                </div>
      
        </div>
        <div class="col-8">
       
                <div class="card">
                    <div class="card-header">
                        Complain Description
                    </div>
                    <div class="card-body">
                       
                        <div class="form-group">
                            Details: <span class="readonly-textarea bg-gray-200 border border-gray-300 p-2 block w-full min-h-[100px] overflow-auto rounded">
                                {{ $complain->complain_details }}
                            </span>
                            
                        </div>
                    </div>
                </div>
 
        </div>
    </div>
    <div class="row">
       <div class="col-md-6 mx-auto mt-3">
        <input type="button" value="Create Fir" wire:click="addFir" class="btn btn-primary btn-block ml-auto pb-2">
       </div>
    </div>
    @endif
</div>
