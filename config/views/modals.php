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
            ["title" => "إضافة الصور", "id" => "upload-images", "status" => "", "icon" => "fas fa-circle-info"],
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
            [
                "id" => "upload-images",
                "status" => "",
                "prev" => "more-info",
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
    ],

    "cities-service" => [
        "tabs" => [
            ["title" => "إضافة مدينة جديدة", "id" => "city-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ],

        "contents" => [
            [
                "id" => "city-info",
                "status" => "active show",
                "prev" => "",
                "next" => "",
                "inputs" => [],
                "checkboxes" => []
            ],
        ]
    ],

    "princedoms-service" => [
        "tabs" => [
            ["title" => "إضافة منطقة جديدة", "id" => "princedom-info", "status" => "active", "icon" => "fas fa-circle-info"],
        ],

        "contents" => [
            [
                "id" => "princedom-info",
                "status" => "active show",
                "prev" => "",
                "next" => "",
                "inputs" => [],
                "checkboxes" => []
            ],
        ]
    ]
];
