<?php


return [

    "users-service" => [
        "status" => [
            "نشط" => "active",
            "غير نشط" => "inactive",
        ],

        "type" => [
            "أدمن" => "admin",
            "مشتري" => "buyer",
            "بائع" => "seller",
        ]
    ],

    "cars-service" => [
        "status" => [
            'جديد' => 'new',
            'مقبول' => 'approved',
            'مرفوض'  => 'rejected'
        ]
    ],

    "offers-service" => [
        "status" => [
            'مقبول' => 'accepted',
            'مرفوض'  => 'rejected',
            'معلق' => 'pending'
        ]
    ],

];
