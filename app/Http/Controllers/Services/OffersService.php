<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OffersService extends Controller
{
    public $name = "العروض";
    public $title_creator = "إضافة عرض جديد";
    public $title_updater = "تعديل بيانات العرض";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-offer-button";
    public $updater_id = "updater-offer-button";
    public $model = Offer::class;

    public function __construct()
    {
        $this->model = new Offer();
    }

    public function model($id)
    {
        return Offer::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Offer::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.columns.offers-service');
    }

    public function rows()
    {
        return config('views.rows.offers-service');
    }

    public function selects()
    {
        return   config('views.search-select-table.offers-service');
    }

    public function create()
    {
        return config('views.create.offers-service');
    }

    public function tabs()
    {
        return [];
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [[], []];

        $contents = [];

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
        return Offer::getRules($id);
    }

    public function messages()
    {
        return Offer::getMessages();
    }

    public function delete($id)
    {
        return Offer::deleteModel($id);
    }

    public function status($status, $id)
    {
        return Offer::status($status, $id);
    }

    public function store($data)
    {
        return Offer::store($data);
    }

    public function update($data, $id)
    {
        return Offer::updateModel($data, $id);
    }

    public function fillable()
    {
        return [];
    }
}
