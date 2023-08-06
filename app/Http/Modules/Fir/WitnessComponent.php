<?php

namespace App\Http\Modules\Fir;

use App\Models\Fir;
use App\Models\Witness;
use Livewire\Component;

class WitnessComponent extends Component
{
    public $fir_id;
    public $addWitness=false;
    public $name;
    public $address;
    public $statement;
    public $contact_number;
    public function mount($fir){
        $this->fir_id =$fir;
    }
    public function render()
    {
        $witness = Witness::where('fir_id','=',$this->fir_id)->get();
        return view('modules.fir.witness-component',['witness'=>$witness]);
    }
    public function closeModal(){
        $this->addWitness =false;
    }

    public function addWitness(){
        $validated = $this->validate();
        Witness::create($validated);
        $this->dispatchBrowserEvent('toast.success', [
            'tite' => "Witness Added Successfully",
            'message' => "Witness Added Successfully",
            'type'=>'success'
        ]);
        $this->resetExcept('fir_id');
    }
    public function rules(){
        return [
            'name'=>'required|min:3',
            'address' => 'required',
            'statement' => 'required|string',
            'contact_number' => 'nullable|min:10|digits',
            'fir_id' => 'required| exists:firs,id'
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
