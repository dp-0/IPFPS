<?php

namespace App\Http\Modules\Search;

use App\Jobs\ImageSearchJob;
use App\Models\ImageSearch as ImageSearchModel;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Component;

class ImageSearch extends Component
{
    use WithFileUploads;
    public $files;
    public $ImageModel;
    public $search = null;
    public $loading = true;

    protected $queryString = ['search'=>['except' => '']];

    protected $listeners = ['update' => '$refresh'];

    public function booted(){
        if($this->search){
            $this->ImageModel = ImageSearchModel::where('uuid',$this->search)->first();
        }
    }
    public function render()
    {
        return view('modules.search.image-search');
    }
    public function rules()
    {
        return [
            'files' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }
    public function updatedFiles()
    {
        $this->validateOnly('files');
        $fileName = $this->files->storePublicly('search', 'public');
        $uuid = Str::uuid()->toString();
        $this->ImageModel = ImageSearchModel::create([
            'user_id' => auth()->user()->id,
            'uuid' => $uuid,
            'status' => 'pending',
            'input_image_path' => $fileName,
        ]);
        $this->search = $uuid;
        unset($this->files);
        ImageSearchJob::dispatch($fileName, $uuid);     
    }

}
