<?php

namespace App\Http\Livewire;

use App\Traits\Helpers;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Updater extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use Helpers;

    protected $listeners = [
        'updater' => 'updater',
        'update' => 'update',
        "refreshComponent" => '$refresh',
    ];

    public $service = '';

    public $fillable = [];
    public $contents = [];
    public $tabs = [];
    public $rules = [];
    public $messages = [];

    public $title = '';
    public $updater_id;
    public $size = '';

    public $model_id = '';

    public $data = [];

    public function mount($service)
    {
        $this->service = $service;
        $service = $this->setService($this->service);
        $this->fillable = $service->fillable();
        $this->setFields($this->fillable);
    }

    public function render()
    {
        $service = $this->setService($this->service);
        $this->getContent($service, "Updater");

        return view('livewire.updater');
    }

    public function updater($service, $id)
    {
        $this->service = $service;
        $this->model_id = $id;

        $service = $this->setService($this->service);

        $model = $service->model($id);

        foreach ($this->fillable as $field) {

            if ($field == "images") {
                $this->{$field} = [];
                continue;
            }

            $this->{$field} = $model->{$field};
        }

        foreach ($this->contents as $content) {

            foreach ($content['inputs'] as $input) {

                if ($input['type'] == 'select') {
                    $input_id  = "#" . $input['id'];
                    $value = $model->{$input['name']};
                    $this->emit('select2Updater', $input_id, $value);
                }

                if ($input['name'] == 'additional_features') {
                    $this->{'additional_features'} = $model->additional_features;
                    $this->emit('setMultiSelectInput', "additional_features_select_id_updater", $model->additional_features);
                }
            }
        }

        $this->data = $this->getFieldsValues($this->fillable);

        $data = json_encode($this->data);
        $this->emit('setDataFields', $data);
    }

    public function update($data)
    {
        $service = $this->setService($this->service);
        $data = $this->getFieldsValues($this->fillable);

        if (!$this->makeValidation($service, $data, 'updateErrors', $this->model_id)) {
            return false;
        }

        $message = $service->update($data, $this->model_id);

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
