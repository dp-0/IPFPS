<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\Complain;

class ViewComplain extends BaseComponent
{
    protected $model = ViewComplain::class;

    public Complain $complain;
    public function render()
    {
        return view('modules.fir.view-complain');
    }

//    public function rules(){
//        return [
//
//        ];
//    }
    public function updated($propertyName)
    {
        parent::updated($propertyName);
//        $this->validateOnly($propertyName);
    }
}
