<?php

namespace App\Http\Modules\Fir;

use App\Models\Complain;
use App\Models\Complainants;
use Livewire\Component;

class ComplinantDetails extends Component
{

    public $complinant;
    public $complains;
    public function mount($complinant){
        $this->complinant = Complainants::find($this->complinant);
        $this->complains = Complain::with('getIncidentType')->where('complain_by','=',$complinant)->get();
    }
    public function render()
    {
        return view('modules.fir.complinant-details');
    }

    
}
