<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarsService extends Controller
{
    public $name = "سيارة";
    public $title_creator = "إضافة إعلان سيارة جديدة";
    public $title_updater = "تعديل بيانات الاعلان";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-car-button";
    public $updater_id = "updater-car-button";
    public $model = Car::class;

    public function __construct()
    {
        $this->model = new Car();
    }

    public function model($id)
    {
        return Car::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return Car::data()
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.columns.cars-service');
    }

    public function rows()
    {
        return config('views.rows.cars-service');
    }

    public function selects()
    {
        return   config('views.search-select-table.cars-service');
    }

    public function create()
    {
        return config('views.create.cars-service');
    }

    public function tabs()
    {
        return config('views.modals.cars-service.tabs');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $years = config('data.years');

        $inputs = [
            [
                input("text", "title", "title_input_id$prefix_id", "fas fa-car", "rtl", "50", "form-control inputText$type", "عنوان الاعلان", true, "عنوان الاعلان", "text-danger reset-validation title-validation"),
                input("text", "price", "price_input_id$prefix_id", "fas fa-hand-holding-dollar", "rtl", "50", "form-control inputText$type", "السعر", true, "السعر", "text-danger reset-validation price-validation"),
                select('select', 'model', "model_select_id$prefix_id", "fas fa-toggle-off", "", "select inputSelect$type", "فئة السيارة", true, getData('cars-models'), "", false, "فئة السيارة", "text-danger model-validation reset-validation"),
                select('select', 'year', "year_select_id$prefix_id", "fas fa-calendar-check", "", "select inputSelect$type", "السنة", true, $years, "", false, "السنة", "text-danger year-validation reset-validation", false, "2019"),
                input("number", "km", "km_input_id$prefix_id", "fas fa-gauge-high", "rtl", "10", "form-control inputText$type", "السرعة", true, "السرعة", "text-danger reset-validation km-validation"),
                select('select', 'body_type', "body_type_select_id$prefix_id", "fas fa-toggle-off", "", "select inputSelect$type", "نوع الجسم", true, getData('body-types'), "", false, "نوع الجسم", "text-danger body_type-validation reset-validation"),
                select('select', 'mechanical_condition', "mechanical_condition_select_id$prefix_id", "fas fa-gears", "", "select inputSelect$type", "الحالة الميكانيكية", true, getData('mechanical-conditions'), "", false, "الحالة الميكانيكية", "text-danger mechanical_condition-validation reset-validation"),
                select('select', 'car_conditions', "car_conditions_select_id$prefix_id", "fas fa-gears", "", "select inputSelect$type", "حالة السيارة", true, getData('car-conditions'), "", false, "حالة السيارة", "text-danger car_conditions-validation reset-validation"),
                select('select', 'seller_type', "seller_type_select_id$prefix_id", "fas fa-user", "", "select inputSelect$type", "نوع البائع", true, getData('seller-types'), "", false, "نوع البائع", "text-danger seller_type-validation reset-validation"),
                select('select', 'transmission', "transmission_select_id$prefix_id", "fas fa-gauge-high", "", "select inputSelect$type", "نوع الناقل", true, getData('transmissions-types'), "", false, "نوع الناقل", "text-danger transmission-validation reset-validation"),
                select('select', 'engine_power', "engine_power_select_id$prefix_id", "fab fa-superpowers", "", "select inputSelect$type", "قوة المحرك", true, getData('engine-powers'), "", false, "قوة المحرك", "text-danger engine_power-validation reset-validation"),
            ],
            [
                select('select', 'regional_specifications', "regional_specifications_select_id$prefix_id", "fab fa-superpowers", "", "select inputSelect$type", "المواصفات الأقليمية", true, getData('regional-specifications'), "", false, "المواصفات الأقليمية", "text-danger regional_specifications-validation reset-validation"),
                select('select', 'insurance', "insurance_select_id$prefix_id", "fas fa-check-double", "", "select inputSelect$type", "الضمان", true, getData('insurances'), "", false, "الضمان", "text-danger insurance-validation reset-validation"),
                select('select', 'driving_hand', "driving_hand_select_id$prefix_id", "fas fa-check-double", "", "select inputSelect$type", "جهة القيادة", true, getData('driving-hand'), "", false, "جهة القيادة", "text-danger driving_hand-validation reset-validation"),
                select('select', 'fuel_type', "fuel_type_select_id$prefix_id", "fas fa-gas-pump", "", "select inputSelect$type", "نوع الوقود", true, getData('fuel-types'), "", false, "نوع الوقود", "text-danger fuel_type-validation reset-validation"),
                select('select', 'outer_color', "outer_color_select_id$prefix_id", "fas fa-palette", "", "select inputSelect$type", "اللون الخارجي", true, getData('colors'), "", false, "اللون الخارجي", "text-danger outer_color-validation reset-validation"),
                select('select', 'inner_color', "inner_color_select_id$prefix_id", "fas fa-palette", "", "select inputSelect$type", "اللون الداخلي", true, getData('colors'), "", false, "اللون الداخلي", "text-danger inner_color-validation reset-validation"),
                select('select', 'door_numbers', "door_numbers_select_id$prefix_id", "fas fa-palette", "", "select inputSelect$type", "عدد الأبواب", true, getData('doors-number'), "", false, "عدد الأبواب", "text-danger door_numbers-validation reset-validation"),
                select('select', 'seat_numbers', "seat_numbers_select_id$prefix_id", "fas fa-palette", "", "select inputSelect$type", "عدد المقاعد", true, getData('seats-number'), "", false, "عدد المقاعد", "text-danger seat_numbers-validation reset-validation"),
                select('select', 'cylinders', "cylinders_select_id$prefix_id", "fas fa-palette", "", "select inputSelect$type", "عدد الاسطوانات", true, getData('cylinders'), "", false, "عدد الاسطوانات", "text-danger cylinders-validation reset-validation"),

                input("text", "technical_features", "technical_features_input_id$prefix_id", "fas fa-gear", "rtl", "50", "form-control inputText$type", "المواصفات التقنية", true, "المواصفات التقنية", "text-danger reset-validation technical_features-validation"),

                select('select', 'additional_features', "additional_features_select_id$prefix_id", "fas fa-palette", "", "select inputSelect$type", "ميزات إضافية", true, getData('additional-features'), "multiple", false, "ميزات إضافية", "text-danger additional_features-validation reset-validation"),
            ]
        ];

        $contents = config('views.modals.cars-service.contents');

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
        return Car::getRules($id);
    }

    public function messages()
    {
        return Car::getMessages();
    }

    public function delete($id)
    {
        return Car::deleteModel($id);
    }

    public function status($status, $id)
    {
        return Car::status($status, $id);
    }

    public function store($data)
    {
        return Car::store($data);
    }

    public function update($data, $id)
    {
        return Car::updateModel($data, $id);
    }

    public function fillable()
    {
        return [
            "title",
            "price",
            "model",
            "year",
            "km",
            "regional_specifications",
            "body_type",
            "mechanical_condition",
            "car_conditions",
            "seller_type",
            "transmission",
            "engine_power",
            "insurance",
            "outer_color",
            "inner_color",
            "door_numbers",
            "seat_numbers",
            "cylinders",
            "fuel_type",
            "technical_features",
            "driving_hand",
            "additional_features",
        ];
    }
}
