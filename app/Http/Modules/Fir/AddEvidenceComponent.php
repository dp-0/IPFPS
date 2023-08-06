<?php

namespace App\Http\Modules\Fir;

use App\Helpers\BaseComponent;
use App\Models\Evidence;
use App\Models\Fir;
use App\Models\User;
use Livewire\WithFileUploads;

class AddEvidenceComponent extends BaseComponent
{
    use WithFileUploads;
    protected $model = Evidence::class;

    public $collected_by;
    public $collected_at;
    public $preserved_by;
    public $preserved_at;
    public $description;
    public $files = [];
    public $evidenceType;
    public Fir $fir;

    public function mount()
    {
        // ini_set('upload_max_filesize', '500M');
        // ini_set('post_max_size', '550M');
    }
    public function render()
    {
        $users = User::select('id', 'name', 'profile_photo_path')->get();
        return view('modules.fir.add-evidence-component', [
            'users' => $users
        ]);
    }

    public function save()
    {
        $validated = $this->validate();
        $filesArray = [];
        foreach ($validated['files'] as $file) {
            $fileName = $file->storePublicly('evidence', 'public');
            $filesArray[] = $fileName;
        }
        $jsonFiles = implode(',', $filesArray);
        $data = Evidence::create(
            [
                'fir_id' => $this->fir->id,
                'description' => $validated['description'],
                'type' => $validated['evidenceType'],
                'collected_by' => $validated['collected_by']['id'],
                'collected_at' => $validated['collected_at'],
                'preserved_by' => $validated['preserved_by']['id'],
                'preserved_at' => $validated['preserved_at'],
                'attachment_path' => $jsonFiles,
            ]
        );
        $this->alert('success', "Evidence Added Successfully");
        $this->resetExcept(['fir']);
        $this->dispatchBrowserEvent('evidence-added', 'success');
    }
    public function rules()
    {
        return [
            'files' => 'required',
            'collected_at' => 'required',
            'collected_by.id' => 'required|exists:users,id',
            'preserved_at' => 'required|after_or_equal:collected_at',
            'preserved_by.id' => 'required|exists:users,id',
            'description' => 'required',
            'evidenceType' => 'required|in:Document,Weapon,DNA_Sample,Other',
        ];
    }
    public function updated($propertyName)
    {
        parent::updated($propertyName);
        $this->validateOnly($propertyName);
    }
}
