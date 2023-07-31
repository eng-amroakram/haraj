<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Princedom;

class PrincedomsService extends Controller
{
    public $name = "الإمارات";
    public $title_creator = "إضافة إمارة جديدة";
    public $title_updater = "تعديل بيانات الإمارة";
    public $modal_size = "";
    public $creator_id = "creator-princedom-button";
    public $updater_id = "updater-princedom-button";
    public $model = Princedom::class;

    public function __construct()
    {
        $this->model = new Princedom();
    }

    public function model($id)
    {
        return Princedom::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Princedom::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.columns.princedoms-service');
    }

    public function rows()
    {
        return config('views.rows.princedoms-service');
    }

    public function selects()
    {
        return config('views.search-select-table.princedoms-service');
    }

    public function create()
    {
        return config('views.create.princedoms-service');
    }

    public function tabs()
    {
        return config('views.modals.princedoms-service.tabs');
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
        return Princedom::getRules($id);
    }

    public function messages($id = "")
    {
        return Princedom::getMessages($id);
    }

    public function delete($id)
    {
        return Princedom::deleteModel($id);
    }

    public function status($id)
    {
        return Princedom::status($id);
    }

    public function store($data)
    {
        return Princedom::store($data);
    }

    public function update($data, $id)
    {
        return Princedom::updateModel($data, $id);
    }

    public function fillable()
    {
        return [
            "name_ar",
            "name_en",
        ];
    }

}
