<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\CasePriority;
use Illuminate\Support\Facades\Validator;


class CasePriorityComponent extends BaseComponent
{

    protected $model = CasePriority::class;

    public $addCasePriority= false;
    public $deleteCasePriority= false;
    public $casePriority_id;
    public $state = [];

    public function render()
    {
        $casePriorities = $this->model::latest()->search($this->search)->paginate($this->perPage);
        return view('modules.fir.case-priority', [
            'casePriorities'=>$casePriorities
        ]);
    }
    public function addCasePriority()
    {
        $validatedData =  $this->validate();
        CasePriority::create($validatedData['state']);
        $this->alert('success','Case Priority created successfully');
        unset($this->state);
        $this->addCasePriority = false;
    }
    public function confirmCasePriorityDeletion($casePriority_id){
       $this->casePriority_id = $casePriority_id;
       $this->deleteCasePriority = true;
    }
    public function deleteCasePriority(){

        $validated = Validator::make(['casePriority_id'=>$this->casePriority_id], ['casePriority_id' => 'required|exists:case_priorities,id'])->validate();
        CasePriority::find($validated['casePriority_id'])->delete();
        $this->alert('success','Case Priority Deleted Successfully');
        $this->erase();
    }
    public function rules(){
        return [
            'state.name' => 'required|min:3|unique:case_priorities,name',
            'state.priority' => 'required|numeric'
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
    protected $validationAttributes = [
        'state.name' => 'Name',
        'state.priority' => 'Priority'
    ];
}
