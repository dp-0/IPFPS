<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\FirStatus;
use Illuminate\Support\Facades\Validator;
class FirStatusComponent extends BaseComponent
{

    protected $model = FirStatus::class;

    public $addFirStatus = false;
    public $deleteFirStatus= false;
    public $firStatus_id;
    public $name = '';

    public function render()
    {
        $firStatus = $this->model::latest()->search($this->search)->paginate($this->perPage);
        return view('modules.fir.fir-status', [
            'firStatus'=>$firStatus
        ]);
    }
    public function addFirStatus()
    {
        $validatedData =  $this->validate();
        FirStatus::create($validatedData);
        $this->alert('success','Fir Status created successfully');
        unset($this->name);
        $this->addFirStatus = false;
    }
    public function confirmFirStatusDeletion($firStatus_id){
       $this->firStatus_id = $firStatus_id;
       $this->deleteFirStatus = true;
    }
    public function deleteFirStatus(){
        $validated = Validator::make(['firStatus_id'=>$this->firStatus_id], ['firStatus_id' => 'required|exists:fir_statuses,id'])->validate();
        FirStatus::find($validated['firStatus_id'])->delete();
        $this->alert('success','Fir Status Deleted Successfully');
        $this->erase();
    }
    public function rules(){
        return [
            'name' => 'required|min:3|unique:fir_statuses,name',
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
