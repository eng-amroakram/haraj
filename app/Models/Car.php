<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'images/cars';

    protected $fillable = [
        "user_id",
        "gallery_id",
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
        "status",
        "published_in",
        "main_image",
        "images",
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "user_id",
            "gallery_id",
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
            "status",
            "published_in",
            "main_image",
            "images",
        ]);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class, "gallery_id", 'id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "ads_user_favorite", "car_id", "user_id", "id", "id");
    }

    public function getMainImageTableAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('assets/images/no-image-available.jpg');
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value);
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        $drivingHands = config("data.rules.driving-hand");

        return [
            "title" => ["required", "string", "max:255"],
            "price" => ["required", "numeric"],
            "model" => ['required', "exists:car_models,id"],
            "year" => ["required", "numeric", "exists:years,id"],
            "km" => ["required", "numeric"],
            "regional_specifications" => ["required", "exists:regional_specifications,id"],
            "body_type" => ["required", "exists:body_types,id"],
            "mechanical_condition"  => ["required", "exists:mechanical_conditions,id"],
            "car_conditions" => ["required", "exists:car_conditions,id"],
            "seller_type" => ["required", "exists:seller_types,id"],
            "transmission" => ["required", "exists:transmissions,id"],
            "engine_power" => ["required", "exists:engine_powers,id"],
            "insurance" => ["required", "exists:insurances,id"],
            "outer_color" => ["required", "exists:outer_colors,id"],
            "inner_color" => ["required", "exists:inner_colors,id"],
            "door_numbers" => ["required", "exists:doors,id"],
            "seat_numbers" => ["required", "exists:seats,id"],
            "cylinders" => ["required", "exists:cylinders,id"],
            "fuel_type" => ["required", "exists:fuel_types,id"],
            "technical_features" => ["required"],
            "driving_hand" => $drivingHands,
            "additional_features" => ["required", "exists:additional_features,id"],
            "main_image" => ["nullable", "max:2048"],
            "images" => ["nullable", "array", "max:5"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "title.required" => __("title is required"),
            "title.string" => __("title must be string"),
            "title.max" => __("title must be less than 255 characters"),
            "price.required" => __("price is required"),
            "price.numeric" => __("price must be numeric"),
            "model.required" => __("model is required"),
            "model.exists" => __("model not exists"),
            "year.required" => __("year is required"),
            "year.numeric" => __("year must be numeric"),
            "year.exists" => __("year not exists"),
            "km.required" => __("km is required"),
            "km.numeric" => __("km must be numeric"),
            "regional_specifications.required" => __("regional specifications is required"),
            "regional_specifications.exists" => __("regional specifications not exists"),
            "body_type.required" => __("body type is required"),
            "body_type.exists" => __("body type not exists"),
            "mechanical_condition.required" => __("mechanical condition is required"),
            "mechanical_condition.exists" => __("mechanical condition not exists"),
            "car_conditions.required" => __("car conditions is required"),
            "car_conditions.exists" => __("car conditions not exists"),
            "seller_type.required" => __("seller type is required"),
            "seller_type.exists" => __("seller type not exists"),
            "transmission.required" => __("transmission is required"),
            "transmission.exists" => __("transmission not exists"),
            "engine_power.required" => __("engine power is required"),
            "engine_power.exists" => __("engine power not exists"),
            "insurance.required" => __("insurance is required"),
            "insurance.exists" => __("insurance not exists"),
            "outer_color.required" => __("outer color is required"),
            "outer_color.exists" => __("outer color not exists"),
            "inner_color.required" => __("inner color is required"),
            "inner_color.exists" => __("inner color not exists"),
            "door_numbers.required" => __("door numbers is required"),
            "door_numbers.exists" => __("door numbers not exists"),
            "seat_numbers.required" => __("seat numbers is required"),
            "seat_numbers.exists" => __("seat numbers not exists"),
            "cylinders.required" => __("cylinders is required"),
            "cylinders.exists" => __("cylinders not exists"),
            "fuel_type.required" => __("fuel type is required"),
            "fuel_type.exists" => __("fuel type not exists"),
            "technical_features.required" => __("technical features is required"),
            "driving_hand.required" => __("driving hand is required"),
            "additional_features.required" => __("additional features is required"),
            "additional_features.exists" => __("additional features not exists"),
            "main_image.image" => __("main image must be image"),
            "main_image.max" => __("main image must be less than 2MB"),
            "images.array" => __("images must be array"),
            "images.max" => __("images must be less than 5"),
        ];
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            "model" => null,
            "year" => null,
            "km" => null,
            "regional_specifications" => null,
            "body_type" => null,
            "mechanical_condition" => null,
            "car_conditions" => null,
            "seller_type" => null,
            "transmission" => null,
            "engine_power" => null,
            "insurance" => null,
            "outer_color" => null,
            "inner_color" => null,
            "door_numbers" => null,
            "seat_numbers" => null,
            "cylinders" => null,
            "fuel_type" => null,
            "technical_features" => null,
            "driving_hand" => null,
            "additional_features" => null,
            'status' => null
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['model'] != null, function ($query) use ($filters) {
            $query->whereIn('model', $filters['model']);
        });

        $builder->when($filters['search'] == '' && $filters['year'] != null, function ($query) use ($filters) {
            $query->whereIn('year', $filters['year']);
        });

        $builder->when($filters['search'] == '' && $filters['km'] != null, function ($query) use ($filters) {
            $query->whereIn('km', $filters['km']);
        });

        $builder->when($filters['search'] == '' && $filters['body_type'] != null, function ($query) use ($filters) {
            $query->whereIn('body_type', $filters['body_type']);
        });

        $builder->when($filters['search'] == '' && $filters['mechanical_condition'] != null, function ($query) use ($filters) {
            $query->whereIn('mechanical_condition', $filters['mechanical_condition']);
        });

        $builder->when($filters['search'] == '' && $filters['seller_type'] != null, function ($query) use ($filters) {
            $query->whereIn('seller_type', $filters['seller_type']);
        });

        $builder->when($filters['search'] == '' && $filters['transmission'] != null, function ($query) use ($filters) {
            $query->whereIn('transmission', $filters['transmission']);
        });

        $builder->when($filters['search'] == '' && $filters['engine_power'] != null, function ($query) use ($filters) {
            $query->whereIn('engine_power', $filters['engine_power']);
        });

        $builder->when($filters['search'] == '' && $filters['insurance'] != null, function ($query) use ($filters) {
            $query->whereIn('insurance', $filters['insurance']);
        });

        $builder->when($filters['search'] == '' && $filters['outer_color'] != null, function ($query) use ($filters) {
            $query->whereIn('outer_color', $filters['outer_color']);
        });

        $builder->when($filters['search'] == '' && $filters['inner_color'] != null, function ($query) use ($filters) {
            $query->whereIn('inner_color', $filters['inner_color']);
        });

        $builder->when($filters['search'] == '' && $filters['car_conditions'] != null, function ($query) use ($filters) {
            $query->whereIn('car_conditions', $filters['car_conditions']);
        });

        $builder->when($filters['search'] == '' && $filters['fuel_type'] != null, function ($query) use ($filters) {
            $query->whereIn('fuel_type', $filters['fuel_type']);
        });

        $builder->when($filters['search'] == '' && $filters['driving_hand'] != null, function ($query) use ($filters) {
            $query->whereIn('driving_hand', $filters['driving_hand']);
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function scopeStatus(Builder $builder, $status, $id)
    {
        $car = $builder->find($id);
        if ($car) {
            $car->update([
                "status" => $status
            ]);
            return __("Ad status updated successfully");
        }

        return false;
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $user = User::find(auth()->id());
        $data["user_id"] = $user->id;
        $data["status"] = "new";
        $data['published_in'] = now();
        $data['gallery_id'] = $user->gallery ? $user->gallery->id : null;

        if (array_key_exists('main_image', $data)) {
            $data['main_image'] = $builder->storeFile($data['main_image']);
        }

        $images_paths = [];

        if (array_key_exists('images', $data)) {
            if ($data['images']) {
                foreach ($data['images'] as $image) {
                    $images_paths[] = $builder->storeFile($image);
                }
            }
        }

        $data['images'] = $images_paths;

        $car = $builder->create($data);

        if ($car) {
            return __("Ad created successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $car = $builder->find($id);
        $image = $data['main_image'];
        $images = $data['images'];

        if (count($images) > 0) {
            $builder->deleteImages($id);
            $images_paths = [];
            foreach ($images as $image) {
                if (gettype($image) == "object") {
                    $images_paths[] = $builder->storeFile($image);
                }
            }
            $data['images'] = $images_paths;
        } else {
            unset($data['images']);
        }

        if (gettype($image) == "object") {
            $builder->deleteMainImage($id);
            $data['main_image'] = $builder->storeFile($image);
            $this->deleteLivewireTempImage();
        } else {
            unset($data['main_image']);
            unset($data['status']);
        }

        if ($car) {
            $car->update($data);
            return __("Ad updated successfully");
        }

        return false;
    }

    public function getAdditionalFeaturesAttribute($value)
    {
        return json_decode($value);
    }

    public function setAdditionalFeaturesAttribute($value)
    {
        $this->attributes['additional_features'] = json_encode($value);
    }

    public function scopeFavoriteModel(Builder $builder, $id)
    {
        $car = $builder->find($id);
        $car->users()->attach(auth()->id());
        return __("Ad added to favorites successfully");
    }

    public function scopeUnFavoriteModel(Builder $builder, $id)
    {
        $car = $builder->find($id);
        $car->users()->detach(auth()->id());
        return __("Ad removed from favorites successfully");
    }

    public function scopeFavorites(Builder $builder)
    {
        return $builder->whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }

    public function scopeMyAds($query)
    {
        return $query->where('user_id', auth()->id())->get();
    }

    public function getModelNameAttribute()
    {
        $locale = app()->getLocale();
        $carModel = CarModel::where('id', $this->model)->first();

        if ($locale == "ar") {
            if ($carModel) {
                return $carModel->name_ar;
            } else {
                return "";
            }
        } else {
            if ($carModel) {
                return $carModel->name_en;
            } else {
                return "";
            }
        }
    }

    public function getYearNameAttribute()
    {
        $locale = app()->getLocale();
        $year = Year::where('id', $this->model)->first();

        if ($locale == "ar") {
            if ($year) {
                return $year->name_ar;
            } else {
                return "";
            }
        } else {
            if ($year) {
                return $year->name_en;
            } else {
                return "";
            }
        }
    }

    public function getkmSpeedAttribute()
    {
        return number_format($this->km);
    }

    public function getPriceCarAttribute()
    {
        return number_format($this->price);
    }

    public function getUserNameAttribute()
    {
        return $this->seller->name;
    }

    public function getBodyTypeNameAttribute()
    {
        $locale = app()->getLocale();
        $body_type = BodyType::where('id', $this->body_type)->first();

        if ($locale == "ar") {
            if ($body_type) {
                return $body_type->name_ar;
            } else {
                return "";
            }
        } else {
            if ($body_type) {
                return $body_type->name_en;
            } else {
                return "";
            }
        }
    }

    public function getMechanicalConditionNameAttribute()
    {
        $locale = app()->getLocale();
        $mechanical_condition = MechanicalCondition::where('id', $this->mechanical_condition)->first();

        if ($locale == "ar") {
            if ($mechanical_condition) {
                return $mechanical_condition->name_ar;
            } else {
                return "";
            }
        } else {
            if ($mechanical_condition) {
                return $mechanical_condition->name_en;
            } else {
                return "";
            }
        }
    }

    public function getSellerTypeNameAttribute()
    {
        $locale = app()->getLocale();
        $seller_type = SellerType::where('id', $this->seller_type)->first();

        if ($locale == "ar") {
            if ($seller_type) {
                return $seller_type->name_ar;
            } else {
                return "";
            }
        } else {
            if ($seller_type) {
                return $seller_type->name_en;
            } else {
                return "";
            }
        }
    }

    public function getTransmissionNameAttribute()
    {
        $locale = app()->getLocale();
        $transmission = Transmission::where('id', $this->transmission)->first();


        if ($locale == "ar") {
            if ($transmission) {
                return $transmission->name_ar;
            } else {
                return "";
            }
        } else {
            if ($transmission) {
                return $transmission->name_en;
            } else {
                return "";
            }
        }
    }

    public function getEnginePowerNameAttribute()
    {
        $locale = app()->getLocale();
        $engine_power = EnginePower::where('id', $this->engine_power)->first();

        if ($locale == "ar") {
            if ($engine_power) {
                return $engine_power->name_ar;
            } else {
                return "";
            }
        } else {
            if ($engine_power) {
                return $engine_power->name_en;
            } else {
                return "";
            }
        }
    }

    public function getStatusNameAttribute()
    {
        return __($this->status);
    }

    public function getAdditionalFeaturesArrayAttribute($value)
    {
        return json_decode($this->additional_features);
    }

    public function scopeFavoriteADS($query)
    {
        return $query->whereHas('users', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }
}
