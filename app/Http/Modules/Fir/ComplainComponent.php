<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\Complain;

class ComplainComponent extends BaseComponent
{
    protected $model = Complain::class;

    public function render()
    {
        $complains = $this->model::latest()->with('getRegisterBy','getIncidentType','getStatus','getComplainBy')->search($this->search)->paginate($this->perPage);
        return view('modules.fir.complain-component', 
        [
            'complains'=>$complains
        ]);
    }
}
