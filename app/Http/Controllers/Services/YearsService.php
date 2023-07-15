<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;

class YearsService extends Controller
{
    public $name = "سنة الصنع";
    public $title_creator = "إضافة سنة صنع جديدة";
    public $title_updater = "تعديل بيانات سنة الصنع";
    public $modal_size = "";
    public $creator_id = "creator-feature-button";
    public $updater_id = "updater-feature-button";
    public $model = Year::class;

    public function __construct()
    {
        $this->model = new Year();
    }

    public function model($id)
    {
        return Year::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Year::data()
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
        return Year::getRules($id);
    }

    public function messages($id = "")
    {
        return Year::getMessages($id);
    }

    public function delete($id)
    {
        return Year::deleteModel($id);
    }

    public function status($id)
    {
        return Year::status($id);
    }

    public function store($data)
    {
        return Year::store($data);
    }

    public function update($data, $id)
    {
        return Year::updateModel($data, $id);
    }

    public function fillable()
    {
        return [
            "name_ar",
            "name_en",
        ];
    }
}
