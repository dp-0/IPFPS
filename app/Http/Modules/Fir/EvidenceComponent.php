<?php

namespace App\Http\Modules\Fir;

use App\Models\Evidence;
use Livewire\Component;

class EvidenceComponent extends Component
{


    public $fir_id;
    public $viewEvidence = false;
    public $modal_evidence;
    public function render()
    {
       $evidences = Evidence::with('collectedBy','preservedBy')->where('fir_id','=',$this->fir_id)->get();
        return view('modules.fir.evidence-component',[
            'evidences' => $evidences
        ]);
    }

    public function viewEvidence($evidence_id){
        $this->viewEvidence = true;
        $this->modal_evidence = Evidence::findOrFail($evidence_id);
    }
    public function closeModal(){
       $this->resetExcept('fir_id');
    }
}
