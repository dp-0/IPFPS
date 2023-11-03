<?php

namespace App\Http\Modules\Fir;


use App\Models\Fir;
use App\Models\FirStatus;
use Livewire\Component;

class ViewFirComponent extends Component
{

    public Fir $fir;
    public function render()
    {
        return view('modules.fir.view-fir-component');
    }


    public function updated($propertyName)
    {
        parent::updated($propertyName);
    }
    public function close(){
        $firStatus = FirStatus::where('name','=','closed')->first();
        $this->fir->status_id = $firStatus->id;
        $this->fir->save();
    }
}
