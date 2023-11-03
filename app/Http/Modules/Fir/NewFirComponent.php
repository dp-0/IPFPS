<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\CasePriority;
use App\Models\Complain;
use App\Models\Fir;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class NewFirComponent extends BaseComponent
{

    protected $model = Fir::class;
    protected $queryString = ['complainNumber' => ['except' => '']];
    public $complainNumber;
    public $complain;

    public function mount(){
        if($this->complainNumber){
            $this->complain = Complain::where('complain_number', $this->complainNumber)->first();
        }
    }
    public function render()
    {
        $firStatus = $this->model::latest()->search($this->search)->paginate($this->perPage);
        $priority = CasePriority::select('id','name')->latest()->get();
        return view('modules.fir.new-fir', [
            'firStatus'=>$firStatus,
            'priorityList' => $priority
        ]);
    }

    public  function complainNumber(){
        $validated = Validator::make(['complainNumber'=>$this->complainNumber],[
            'complainNumber' => 'required|exists:complains,complain_number'
        ]);
        if($validated->fails()){
            $this->complain = null;
        }else{
            $this->complain = Complain::where('complain_number', $this->complainNumber)->first();
        }
    }
    public function addFir()
    {
        if(!$this->complainNumber){
            $this->alert('error','Complain Number Not Found');
            return;
        }
        $this->validate();
        $fir = Fir::where('case_number',$this->complainNumber)->get()->toArray();
        if($fir) {
            $this->alert('error',"Fir already register for this complain");
            return;
        }
        if($this->complain){

        $fir = Fir::create([
                'priority_id'=>1,
                'address' => $this->complain->address,
                'incident_details'=> $this->complain->complain_details,
                'complain_by' => $this->complain->complain_by,
                'register_by' => $this->complain->register_by,
                'case_number' => $this->complain->complain_number,
                'warrant_number' => 'FIR-' . uniqid(),
                'incident_type_id' =>$this->complain->incident_type_id,
                'investigation_start_date'=>now(),
                'status_id' =>1,
                'reported_at' => $this->complain->reported_at,
                'incident_date' => $this->complain->incident_date,
            ]);
            return redirect()->route('admin.fir.view', ['fir' => $fir->id]);
        }
    }

    public function rules(){
        return [
            'complainNumber' => 'required|exists:complains,complain_number'
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
