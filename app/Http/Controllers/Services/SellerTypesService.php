<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\SellerType;
use Illuminate\Http\Request;

class SellerTypesService extends Controller
{
    public $name = "نوع البائع";
    public $title_creator = "إضافة نوع بائع جديد";
    public $title_updater = "تعديل بيانات نوع البائع";
    public $modal_size = "";
    public $creator_id = "creator-feature-button";
    public $updater_id = "updater-feature-button";
    public $model = SellerType::class;

    public function __construct()
    {
        $this->model = new SellerType();
    }

    public function model($id)
    {
        return SellerType::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return SellerType::data()
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
        return SellerType::getRules($id);
    }

    public function messages($id = "")
    {
        return SellerType::getMessages($id);
    }

    public function delete($id)
    {
        return SellerType::deleteModel($id);
    }

    public function status($id)
    {
        return SellerType::status($id);
    }

    public function store($data)
    {
        return SellerType::store($data);
    }

    public function update($data, $id)
    {
        return SellerType::updateModel($data, $id);
    }

    public function fillable()
    {
        return [
            "name_ar",
            "name_en",
        ];
    }
}
