<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Services\Services;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        // 'delete',
        // 'edit',
        'submit',
        'updateTable' => '$refresh',
    ];

    public $table = '';
    private $service = null;
    // public $data = [];
    public $columns = [];
    public $rows = [];
    public $selects = [];
    public $table_name = '';

    public $search = '';
    public $rows_number = 5;
    public $sort_field = 'id';
    public $sort_direction = 'desc';
    public $style_sort_direction = 'sorting_desc';
    public $paginate_ids = [];

    public $create;
    public $updater_id;
    public $edit;

    public $filters = [];

    public function mount($service)
    {
        $this->table = $service;
        $obj_service = $this->setService();
        $this->setSelectsSearch($obj_service, true);
    }

    private function setService()
    {
        $this->service = Services::createInstance($this->table) ?? new Services();
        return $this->service;
    }

    public function setSelectsSearch($service, $is_init = true)
    {
        $selects = $service->selects();

        if ($is_init) {
            foreach ($selects as $name => $options) {
                $this->{$name} = null;
            }

            return true;
        }

        $selects = $service->selects();
        foreach ($selects as $name => $options) {
            $this->filters["$name"] = $this->{$name};
        }
    }

    public function getServiceData($service)
    {
        $this->filters['search'] = trim($this->search);
        return $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number);
    }

    public function getContent($service)
    {
        $this->setSelectsSearch($service, false);
        $data = $this->getServiceData($service);
        $this->columns = $service->columns();
        $this->selects = $service->selects();
        $this->create = $service->create();
        $this->rows = $service->rows();
        $this->table_name = $service->name;
        $this->updater_id = $service->updater_id;
        return $data;
    }

    public function edit($id)
    {
        $this->emit("updater", $this->table, $id);
    }

    public function show($id)
    {
        return $this->setService()->show($id);
    }

    public function render()
    {
        $service = $this->setService();
        $data = $this->getContent($service);
        $this->resetPage();

        return view('livewire.table', [
            'data' => $data,
            'columns' => $this->columns,
            'rows' => $this->rows,
            'table_name' => $this->table_name,
            'selects' => $this->selects
        ]);
    }

    public function delete($id)
    {
        $service = $this->setService();
        $result = $service->delete($id);
        if ($result) {
            $this->alertMessage($result, 'success');
            return true;
        }
        $this->alertMessage("حدث خطأ في عملية الحذف، يرجى المحاولة مرة اخرى", 'error');
        return false;
    }

    public function status($id, $field)
    {
        if ($field == 1) {
            $field = 'status';
        } elseif ($field == 2) {
            $field = 'can_add_ad';
        } elseif ($field == 3) {
            $field = 'can_add_offer';
        }

        $service = $this->setService();
        $result = $service->status($id, $field);
        if ($result) {
            $this->alertMessage($result, 'success');
            return true;
        }
        $this->alertMessage("حدث خطأ في عملية الحذف، يرجى المحاولة مرة اخرى", 'error');
        return false;
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => 'top-start',
            'timer' => 3000,
            'text' => $message,
            'timerProgressBar' => true,
        ]);
    }

    public function changeStatus($status, $id)
    {
        $status = car_statuses()[$status];
        $service = $this->setService();
        $message = $service->status($status, $id);

        if ($message) {
            $this->alertMessage($message, 'success');
            return true;
        }

        $this->alertMessage("حدث خطأ في عملية التعديل، يرجى المحاولة مرة اخرى", 'error');
    }
}
