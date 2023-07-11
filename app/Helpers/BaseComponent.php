<?php

namespace App\Helpers;

use App\Helpers\checkPermissions;
use Livewire\Component;
use Livewire\WithPagination;

class BaseComponent extends Component
{
    use WithPagination;
    use CheckPermissions;

    protected $listeners = ['erase' => 'erase'];
    protected $queryString = ['search' => ['except' => '']];
    public $search = '';
    public $perPage = 10;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'search' => 'nullable',
            'perPage' => 'in:-1,10,20,50,100,500,100',
        ]);
        if ($this->perPage == -1) {
            $this->perPage = $this->model::count();
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function alert($type,$message,$title=null)
    {
        $this->dispatchBrowserEvent('toast.success', [
            'tite' => $title,
            'message' => $message,
            'type'=>$type
        ]);
    }
    public function erase(){
        $this->resetExcept(['search','perPage']);
    }
}
