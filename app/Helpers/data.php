<?php


if (!function_exists('getData')) {
    function getData($type)
    {
        $data = config("data.data.$type");

        $get = [];
        if (!$data) {
            dd("data not found", $type);
        }
        foreach ($data as $info) {
            $get[__("$info")] = $info;
        }
        return $get;
    }
}

if (!function_exists('car_statuses')) {
    function car_statuses()
    {
        return ['new', 'approved', 'rejected'];
    }
}


if (!function_exists('car_status_class')) {
    function car_status_class($type)
    {
        if ($type == "جديد") {
            return "btn btn-sm btn-outline-warning btn-rounded";
        }

        if ($type == "مقبول") {
            return "btn btn-sm btn-outline-success btn-rounded";
        }

        if ($type == "مرفوض") {
            return "btn btn-sm btn-outline-danger btn-rounded";
        }

        return "btn btn-sm btn-outline-warning btn-rounded";
    }
}
