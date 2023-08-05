<?php

namespace App\Http\Livewire;

use App\Traits\Helpers;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Creator extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use Helpers;

    protected $listeners = [
        "store" => "store",
        "refresh" => '$refresh',
    ];

    public $service = '';
    public $fillable = [];

    public $contents = [];
    public $tabs = [];
    public $rules = [];
    public $messages = [];

    public $title = '';

    public $creator_id;
    public $size = '';

    public $name = '';

    public function mount($service)
    {
        $this->service = $service;
        $service = $this->setService($this->service);
        $this->fillable = $service->fillable();
        $this->setFields($this->fillable);
    }

    public function getContent($service)
    {
        $this->title = $service->title_creator;
        $this->creator_id = $service->creator_id;
        $this->size = $service->modal_size;
        $this->tabs = $service->tabs();
        $this->contents = $service->contents("Creator");
    }

    public function render()
    {
        $service = $this->setService($this->service);
        $this->getContent($service);

        return view('livewire.creator');
    }

    public function store($data)
    {
        $service = $this->setService($this->service);
        $data = $this->getFieldsValues($this->fillable);

        if (!$this->makeValidation($service, $data, "creator-errors")) {
            return false;
        }

        $message = $service->store($data);

        if ($message) {
            $this->alertMessage($message, 'success');
            $this->emit('updateTable');
            $this->emit('closeModal');
            $this->emit('refresh');
            $this->setFields($this->fillable);
            return true;
        }

        $this->alertMessage('حدث خطأ ما', 'error');
    }
}
