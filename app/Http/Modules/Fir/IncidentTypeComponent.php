<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\IncidentType;
use Illuminate\Support\Facades\Validator;


class IncidentTypeComponent extends BaseComponent
{

    protected $model = IncidentType::class;

    public $addIncidentType = false;
    public $deleteIncidentType= false;
    public $incidentType_id;
    public $name = '';

    public function render()
    {
        $incidentTypes = $this->model::latest()->search($this->search)->paginate($this->perPage);
        return view('modules.fir.incident-type', [
            'incidentTypes'=>$incidentTypes
        ]);
    }
    public function addIncidentType()
    {
        $validatedData =  $this->validate();
        IncidentType::create($validatedData);
        $this->alert('success','Incident Type created successfully');
        unset($this->name);
        $this->addIncidentType = false;
    }
    public function confirmIncidentTypeDeletion($incidentType_id){
       $this->incidentType_id = $incidentType_id;
       $this->deleteIncidentType = true;
    }
    public function deleteIncidentType(){

        $validated = Validator::make(['incidentType_id'=>$this->incidentType_id], ['incidentType_id' => 'required|exists:complainants,id'])->validate();
        IncidentType::find($validated['incidentType_id'])->delete();
        $this->alert('success','Incident Type Deleted Successfully');
        $this->erase();
    }
    public function rules(){
        return [
            'name' => 'required|min:3|unique:incident_types,name',
        ];
    }
    public function closeModal(){
        $this->erase();
    }
    public function updated($propertyName)
    {
        parent::updated($propertyName);
       $this->validateOnly($propertyName);
    }
}
