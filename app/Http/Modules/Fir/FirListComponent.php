<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\Fir;
class FirListComponent extends BaseComponent
{
    protected $model = Fir::class;
    public function render()
    {
        $firs = $this->model::with('getComplainBy','getRegisterBy','getIncidentType','getStatus','getPriority')->latest()->search($this->search)->paginate($this->perPage);
        return view('modules.fir.fir-list', [
            'firs'=>$firs
        ]);
    }
    public function updated($propertyName)
    {
        parent::updated($propertyName);
    }
}
