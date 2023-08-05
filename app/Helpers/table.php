<?php

if (!function_exists('badge')) {
    function badge($type)
    {
        if (in_array($type, ["مدير", "مرفوض"])) {
            return "badge rounded-pill badge-danger";
        }

        if (in_array($type, ["مشتري", "جديد", "قيد الانتظار"])) {
            return "badge rounded-pill badge-warning";
        }

        if (in_array($type, ["بائع"])) {
            return "badge rounded-pill badge-info";
        }

        if (in_array($type, ["مقبول"])) {
            return "badge rounded-pill badge-success";
        }
    }
}

if (!function_exists('input')) {
    function input($type, $name, $id, $icon, $dir = "rtl", $maxlength = "50", $class, $placeholder = "", $defer = true, $lable = "", $validation = "", $disabled = false, $value = "", $accept = '', $multiple = '')
    {
        return [
            "type" => $type,
            "name" => $name,
            "icon" => $icon,
            "dir" => $dir,
            "maxlength" => $maxlength,
            "class" => $class,
            "id" => $id,
            "value" => $value,
            "placeholder" => $placeholder,
            "defer" => $defer,
            "lable" => $lable,
            "validation" => $validation,
            "disabled" => $disabled,
            "accept" => $accept,
            "multiple" => $multiple

        ];
    }
}

if (!function_exists('select')) {
    function select($type = "select", $name, $id, $icon, $dir = "", $class, $placeholder = "", $search = false, $options, $multiple = "", $defer = true, $lable = "", $validation = "", $disabled = false)
    {
        return [
            "type" => $type,
            "name" => $name,
            "icon" => $icon,
            "dir" => $dir,
            "class" => $class,
            "placeholder" => $placeholder,
            "search" => $search,
            "id" => $id,
            "options" => $options,
            "multiple" => $multiple,
            "defer" => $defer,
            "lable" => $lable,
            "validation" => $validation,
            "disabled" => $disabled

        ];
    }
}

if (!function_exists('edit_table')) {
    function edit_table($service, $id)
    {
        $service = "App\Http\Controllers\Services\\" . $service;
        $service = new $service;
        return $service->edit($id);
    }
}
