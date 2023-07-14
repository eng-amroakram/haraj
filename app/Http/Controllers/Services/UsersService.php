<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersService extends Controller
{
    public $name = "المستخدمين";
    public $title_creator = "إنشاء مستخدم جديد";
    public $title_updater = "تعديل بيانات المستخدم";
    public $modal_size = "modal-lg";
    public $creator_id = "creator-user-button";
    public $updater_id = "updater-user-button";
    public $model = User::class;

    public function __construct()
    {
        $this->model = new User();
    }

    public function model($id)
    {
        return User::find($id);
    }

    public function data($filters, $sort_field, $sort_direction, $paginate = 10)
    {
        return User::data()
            ->whereNot('id', auth()->id())
            ->filters($filters)
            ->reorder($sort_field, $sort_direction)
            ->paginate($paginate);
    }

    public function columns()
    {
        return config('views.columns.users-service');
    }

    public function rows()
    {
        return config('views.rows.users-service');
    }

    public function selects()
    {
        return   config('views.search-select-table.users-service');
    }

    public function create()
    {
        return config('views.create.users-service');
    }

    public function tabs()
    {
        return config('views.modals.users-service.tabs');
    }

    public function contents($type)
    {
        $prefix_id = $type == "Updater" ? "_updater" : "_creator";

        $inputs = [
            [
                input("text", "name", "name_input_id$prefix_id", "far fa-user", "rtl", "50", "form-control inputText$type", "اسم المستخدم", true, "اسم المستخدم", "text-danger reset-validation name-validation"),
                input("email", "email", "email_input_id$prefix_id", "fas fa-at", "ltr", "50", "form-control inputText$type", "البريد الالكتروني", true, "البريد الالكتروني", "text-danger reset-validation email-validation"),
                input("text", "phone", "phone_input_id$prefix_id", "fas fa-phone", "ltr", "9", "form-control inputText$type", "رقم الجوال", true, "رقم الجوال", "text-danger reset-validation phone-validation"),
                input("password", "password", "password_input_id$prefix_id", "fas fa-key", "ltr", "50", "form-control inputText$type", "كلمة السر", true, "كلمة السر", "text-danger reset-validation password-validation"),
                select("select", "type", "type_select_id$prefix_id", "fas fa-elevator", "", "select inputSelect$type", "نوع المستخدم", false, ["ادمن فرعي" => "admin", "بائع" => "seller", "مشتري" => "buyer",], "", false, "نوع المستخدم", "text-danger reset-validation type-validation"),
            ]
        ];

        $contents = config('views.modals.users-service.contents');

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
        return User::getRules($id);
    }

    public function messages()
    {
        return User::getMessages();
    }

    public function delete($id)
    {
        return User::deleteModel($id);
    }

    public function status($id)
    {
        return User::status($id);
    }

    public function store($data)
    {
        return User::store($data);
    }

    public function update($data, $id)
    {
        return User::updateModel($data, $id);
    }

    public function fillable()
    {
        return [
            'name',
            'email',
            'password',
            'phone',
            'type',
        ];
    }
}
