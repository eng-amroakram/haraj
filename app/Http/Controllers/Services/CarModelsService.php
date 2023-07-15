<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelsService extends Controller
{
    public $name = "موديل السيارة";
    public $title_creator = "إضافة موديل سيارة جديدة";
    public $title_updater = "تعديل بيانات الموديل";
    public $modal_size = "";
    public $creator_id = "creator-feature-button";
    public $updater_id = "updater-feature-button";
    public $model = CarModel::class;

    public function __construct()
    {
        $this->model = new CarModel();
    }

    public function model($id)
    {
        return CarModel::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return CarModel::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.columns.features-service');
    }

    public function rows()
    {
        return config('views.rows.features-service');
    }

    public function selects()
    {
        return config('views.search-select-table.features-service');
    }

    public function create()
    {
        return config('views.create.features-service');
    }

    public function tabs()
    {
        return config('views.modals.features-service.tabs');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [
            [
                input("text", "name_ar", "name_ar_input_id$prefix_id", "fas fa-car", "rtl", "50", "form-control inputText$type", "الاسم بالعربية", true, "الاسم بالعربية", "text-danger reset-validation name_ar-validation"),
                input("text", "name_en", "name_en_input_id$prefix_id", "fas fa-car", "rtl", "50", "form-control inputText$type", "الاسم بالإنجليزية", true, "الاسم بالإنجليزية", "text-danger reset-validation name_en-validation"),
            ],
        ];

        $contents = config('views.modals.features-service.contents');

        $x = 0;

        foreach ($contents as $content) {
            $content["inputs"] = $inputs[$x];
            $contents[$x] = $content;
            $x++;
        }

        return $contents;
    }

    public function rules($id = "")
    {
        return CarModel::getRules($id);
    }

    public function messages($id = "")
    {
        return CarModel::getMessages($id);
    }


    public function delete($id)
    {
        return CarModel::deleteModel($id);
    }

    public function status($id)
    {
        return CarModel::status($id);
    }

    public function store($data)
    {
        return CarModel::store($data);
    }

    public function update($data, $id)
    {
        return CarModel::updateModel($data, $id);
    }

    public function fillable()
    {
        return [
            "name_ar",
            "name_en",
        ];
    }
}
