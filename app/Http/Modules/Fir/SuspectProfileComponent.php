<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\Suspect;

class SuspectProfileComponent extends BaseComponent
{
    protected $model = Suspect::class;

    public Suspect $suspect;
    public function render()
    {
       
        return view('modules.fir.suspect-profile-component');
    }

    // public function rules(){
    //     return [
            
    //     ];
    // }
    public function updated($propertyName)
    {
        parent::updated($propertyName);
        // $this->validateOnly($propertyName);
    }
}
