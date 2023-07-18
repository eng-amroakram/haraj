<?php


return [

    "users-service" => [
        "id" => 'property',
        "name" => 'property',
        "phone" => 'property',
        "email" => 'property',
        "type_name" => 'badge',
        "status" => 'status',
        "actions" => ["delete", "edit",],
    ],

    "cars-service" => [
        "id" => "property",
        "user_name" => "property",
        "title" => "property",
        "price_car" => "property",
        "model_name" => "property",
        "year_name" => "property",
        "km_speed" => "property",
        "body_type_name" => "property",
        "mechanical_condition_name" => "property",
        "seller_type_name" => "property",
        "transmission_name" => "property",
        "engine_power_name" => "property",
        "status_name" => "dropdown-buttons",
        "actions" => ["show", "edit", "delete"],
    ],

    "offers-service" => [
        "id" => "property",
        "ad_name" => "property",
        "buyer_name" => "property",
        "seller_name" => "property",
        "price" => "property",
        "status_name" => "badge",
        "description" => "property",
    ],

    "features-service" => [
        "id" => "property",
        "name_ar" => "property",
        "name_en" => "property",
        "status" => "status",
        "actions" => ["delete", "edit"],
    ],
];
