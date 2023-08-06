<?php

namespace App\Http\Modules\Fir;

use App\Models\Suspect;
use App\Models\Witness;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class SuspectComponent extends Component
{
    use WithFileUploads;
    public $fir_id;
    public $name;
    public $age;
    public $gender;
    public $address;
    public $nationality;
    public $phone;
    public $email;
    public $description;
    public $photo;
    public $arrest_date;
    public $released_date;
    public $remarks;
    public $addSuspect = false;
    public $updateSuspect = false;
    public $suspect_id;
    public function mount($fir_id)
    {
        $this->fir_id = $fir_id;
    }
    public function render()
    {
        $suspects = Suspect::where('fir_id', '=', $this->fir_id)->get();
        $suspect = null;
        if ($this->updateSuspect) {
            $suspect = $suspects->find($this->suspect_id);
            $this->arrest_date = ($this->arrest_date) ?: $suspect->arrest_date;
            $this->released_date = ($this->released_date) ?: $suspect->released_date;
        }
        return view('modules.fir.suspect-component', ['suspects' => $suspects, 'u_suspect' => $suspect]);
    }
    public function closeModal()
    {
        $this->addSuspect = false;
        $this->updateSuspect = false;
    }

    public function addSuspect()
    {
        $validated = $this->validate();
        $fileName = $validated['photo']->storePublicly('suspects-photo', 'public');
        $validated['photo'] = $fileName;
        Suspect::create($validated);
        $this->dispatchBrowserEvent('toast.success', [
            'title' => "Suspect",
            'message' => "Suspect Added Successfully",
            'type' => "success"
        ]);
        $this->resetExcept('fir_id');
    }

    public function updateSuspect($suspect_id)
    {
        $this->suspect_id = $suspect_id;
        $this->resetExcept('suspect_id','fir_id');
        $this->updateSuspect = true;
    }
    public function update()
    {
        $validated =  Validator::make([
            'arrest_date' => $this->arrest_date,
            'released_date' => $this->released_date,
            'suspect_id' => $this->suspect_id
        ], [
            'arrest_date' => 'nullable|date',
            'released_date' => 'nullable|date|after_or_equal:arrest_date',
            'suspect_id' => 'required|exists:suspects,id'
        ]);
        
        $validated = $validated->validate();
        $suspect = Suspect::find($this->suspect_id);
        if($suspect->arrest_date){
            $suspect->update([
                'released_date' => $validated['released_date'],
            ]);
            $this->dispatchBrowserEvent('toast.success', [
                'title' => "Suspect",
                'message' => "Suspect updated Successfully",
                'type' => "success"
            ]);
            $this->resetExcept('fir_id');
            return;
        }
        $suspect->update([
            'arrest_date' => $validated['arrest_date'],
            'released_date' => $validated['released_date'],
        ]);
        $this->dispatchBrowserEvent('toast.success', [
            'title' => "Suspect",
            'message' => "Suspect updated Successfully",
            'type' => "success"
        ]);
        $this->resetExcept('fir_id');
    }
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'age' => 'required|integer',
            'gender' => 'required|in:male,female,other',
            'address' => 'required',
            'nationality' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'description' => 'nullable',
            'photo' => 'required',
            'arrest_date' => 'nullable|date',
            'released_date' => 'nullable|date',
            'remarks' => 'nullable',
            'fir_id' => 'required|exists:firs,id'
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
