<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\Complain;
use App\Models\Complainants;
use App\Models\IncidentType;
use App\Models\User;
use Illuminate\Support\Carbon;

class NewComplainComponent extends BaseComponent
{
    protected $model = NewComplainComponent::class;

    public $complinant;
    public $incident_type;
    public $details;
    public $incident_date;
    public $address;
    public $title;
    public function render()
    {
        $complinants = Complainants::latest()->select('id','name','profile_photo_path')->get();
        $incidents = IncidentType::latest()->select('id','name')->get();
        return view('modules.fir.new-complain-component',[
            'complinants' => $complinants,
            'incidents' => $incidents
        ]);
    }

    public function newComplain(){
        $validated =  $this->validate();
        $comp = Complain::create([
            'address' => $validated['address'],
            'title' => $validated['title'],
            'complain_details' => $validated['details'],
            'complain_number' => 'CMP-' . uniqid(),
            'reported_at' => Carbon::now(),
            'incident_date' => $validated['incident_date'],
            'register_by' => auth()->id(),
            'complain_by' => $validated['complinant']['id'],
            'incident_type_id' => $validated['incident_type'],
            'status_id' => 1,
        ]);
        $this->alert('success','Complain register successfully');
        $this->erase();
    }
     public function rules(){
         return [
                'title' => 'required|string',
                'address' => 'required|min:3|string',
                'details' => 'required',
                'incident_date' => 'required|date|before:tomorrow',
                'incident_type' => 'required|exists:incident_types,id',
                'complinant.id' => 'required|exists:complainants,id'
         ];
     }
    public function updated($propertyName)
    {
        parent::updated($propertyName);
         $this->validateOnly($propertyName);
    }
}
