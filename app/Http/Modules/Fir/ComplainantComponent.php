<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\Complainants;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class ComplainantComponent extends BaseComponent
{
    use WithFileUploads;
    protected $model = Complainants::class;

    public $addComplainants = false;
    public $deleteComplainants = false;
    public $complainants_id;
    public $complainant = ['photo'=>''];

    public function render()
    {
        $complainants = $this->model::latest()->search($this->search)->paginate($this->perPage);
        return view('modules.fir.complainant-component', [
            'complainants'=>$complainants
        ]);
    }
    public function addComplainant()
    {
        $validatedData =  $this->validate();
        $validatedData = $validatedData['complainant'];
        $fileName = $validatedData['photo']->storePublicly('complainant-photo', 'public');
        $validatedData['profile_photo_path'] = $fileName;
        unset($validatedData['photo']);
        Complainants::create($validatedData);
        $this->alert('success','Complainants created successfully');
        $this->complainant = [];
        $this->addComplainants = false;
    }
    public function rules(){
        return [
            'complainant.name' => 'required|min:3',
            'complainant.mobile_no' => 'required|numeric|digits:10',
            'complainant.address' => 'required',
            'complainant.photo' => 'required|image|max:2048'
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
    protected $validationAttributes = [
        'complainant.name' => 'Name',
        'complainant.mobile_no' => 'Mobile No',
        'complainant.address' => 'Address',
        'complainant.photo' => 'Photo',
    ];
}
