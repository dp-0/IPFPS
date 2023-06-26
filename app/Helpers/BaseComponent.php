<?php

namespace App\Helpers;

use App\Helpers\checkPermissions;
use Livewire\Component;
use Livewire\WithPagination;

class BaseComponent extends Component
{
    use WithPagination;
    use CheckPermissions;


    protected $queryString = ['search' => ['except' => '']];
    public $search = '';
    public $perPage = 10;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
    protected $rules = [
        'search' => 'nullable',
        'perPage' => 'in:-1,10,20,50,100,500,100',
    ];

    public function alertSuccess($message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => $message,
        ]);
    }
}
