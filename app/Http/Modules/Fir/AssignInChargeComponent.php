<?php

namespace App\Http\Modules\Fir;

use App\Models\FirToOfficer;
use App\Models\User;
use Livewire\Component;

class AssignInChargeComponent extends Component
{


    public $fir_id;
    public $new_officer;
    public $perPage=5;
    public function render()
    {
        $officers = FirToOfficer::with('user')->where('fir_id','=',$this->fir_id)->latest()->paginate($this->perPage);
        $users = User::where('utype','=','police')->select('id','name','profile_photo_path')->get();
        return view('modules.fir.assign-in-charge-component',['officers'=>$officers,'users'=>$users]);
    }
    public function addInCharge(){
        $validated = $this->validate();
        $oldOfficer =  FirToOfficer::where('fir_id', $this->fir_id)
        ->whereNull('end_date')
        ->first();
        if($oldOfficer){
            $oldOfficer->end_date = now();
            $oldOfficer->save();
        }
       FirToOfficer::create([
            'fir_id'=>$validated['fir_id'],
            'user_id'=>$validated['new_officer']['id'],
            'start_date'=>now(),
            'end_date'=>NULL
        ]);
        $this->alert('success','Incaharge Assign successfully');
        $this->resetExcept('fir_id','per_page','officers');
    }
    public function rules(){
        return [
            'new_officer.id'=>'required|exists:users,id',
            'fir_id' => 'required|exists:firs,id'
        ];
    }
    public function updated($propertyName)
    {
        parent::updated($propertyName);
        $this->validateOnly($propertyName);
    }
    public function alert($type,$message,$title=null)
    {
        $this->dispatchBrowserEvent('toast.success', [
            'tite' => $title,
            'message' => $message,
            'type'=>$type
        ]);
    }
}
