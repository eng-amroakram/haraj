<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\City;

class CitiesService extends Controller
{
    public $name = "المدن";
    public $title_creator = "إضافة مدينة جديدة";
    public $title_updater = "تعديل بيانات المدينة";
    public $modal_size = "";
    public $creator_id = "creator-city-button";
    public $updater_id = "updater-city-button";
    public $model = City::class;

    public function __construct()
    {
        $this->model = new City();
    }

    public function model($id)
    {
        return City::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return City::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.columns.cities-service');
    }

    public function rows()
    {
        return config('views.rows.cities-service');
    }

    public function selects()
    {
        return config('views.search-select-table.cities-service');
    }

    public function create()
    {
        return config('views.create.cities-service');
    }

    public function tabs()
    {
        return config('views.modals.cities-service.tabs');
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
        return City::getRules($id);
    }

    public function messages($id = "")
    {
        return City::getMessages($id);
    }

    public function delete($id)
    {
        return City::deleteModel($id);
    }

    public function status($id)
    {
        return City::status($id);
    }

    public function store($data)
    {
        return City::store($data);
    }

    public function update($data, $id)
    {
        return City::updateModel($data, $id);
    }

    public function fillable()
    {
        return [
            "name_ar",
            "name_en",
        ];
    }
}
