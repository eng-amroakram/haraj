<?php


return [
    "users-service" => [
        "tabs" => [
            ["title" => "معلومات المستخدم", "id" => "user-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ],
        "contents" => [
            [
                "id" => "user-info",
                "status" => "active show",
                "prev" => "",
                "next" => "",
                "inputs" => [],
                "checkboxes" => []
            ],
        ]
    ],

    "cars-service" => [
        "tabs" => [
            ["title" => "معلومات السيارة الاساسية", "id" => "car-info", "status" => "active", "icon" => "fas fa-circle-info"],
            ["title" => "مواصفات إضافية", "id" => "more-info", "status" => "", "icon" => "fas fa-circle-info"],
        ],

        "contents" => [
            [
                "id" => "car-info",
                "status" => "active show",
                "prev" => "",
                "next" => "more-info",
                "inputs" => [],
                "checkboxes" => []
            ],
            [
                "id" => "more-info",
                "status" => "",
                "prev" => "car-info",
                "next" => "",
                "inputs" => [],
                "checkboxes" => []
            ],
        ]
    ],

    "features-service" => [
        "tabs" => [
            ["title" => "إضافة ميزة جديدة", "id" => "feature-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ],

        "contents" => [
            [
                "id" => "feature-info",
                "status" => "active show",
                "prev" => "",
                "next" => "",
                "inputs" => [],
                "checkboxes" => []
            ],
        ]
    ]
];
