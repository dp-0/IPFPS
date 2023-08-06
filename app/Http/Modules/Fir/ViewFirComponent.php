<?php

namespace App\Http\Modules\Fir;


use App\Models\Fir;
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
}
