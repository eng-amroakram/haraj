<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
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
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "user_id",
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

    public function buyer()
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "ads_user_favorite", "car_id", "user_id", "id", "id");
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        $models = config("data.rules.cars-models");
        $years = config("data.rules.years");
        $regionalSpecifications = config("data.rules.regional-specifications");
        $bodyTypes = config("data.rules.body-types");
        $mechanicalConditions = config("data.rules.mechanical-conditions");
        $carConditions = config("data.rules.car-conditions");
        $sellerTypes = config("data.rules.seller-types");
        $transmissions = config("data.rules.transmissions-types");
        $enginePowers = config("data.rules.engine-powers");
        $insurances = config("data.rules.insurances");
        $colors = config("data.rules.colors");
        $doorNumbers = config("data.rules.doors-number");
        $seatNumbers = config("data.rules.seats-number");
        $cylinders = config("data.rules.cylinders");
        $fuelTypes = config("data.rules.fuel-types");
        $technicalFeatures = config("data.rules.technical-features");
        $drivingHands = config("data.rules.driving-hand");
        $additionalFeatures = config("data.rules.additional-features");

        return [
            "title" => "required|string|max:255",
            "price" => "required|numeric",
            "model" => $models,
            "year" => $years,
            "km" => "required",
            "regional_specifications" => $regionalSpecifications,
            "body_type" => $bodyTypes,
            "mechanical_condition"  => $mechanicalConditions,
            "car_conditions" => $carConditions,
            "seller_type" => $sellerTypes,
            "transmission" => $transmissions,
            "engine_power" => $enginePowers,
            "insurance" => $insurances,
            "outer_color" => $colors,
            "inner_color" => $colors,
            "door_numbers" => $doorNumbers,
            "seat_numbers" => $seatNumbers,
            "cylinders" => $cylinders,
            "fuel_type" => $fuelTypes,
            "technical_features" => $technicalFeatures,
            "driving_hand" => $drivingHands,
            "additional_features" => $additionalFeatures,
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "title.required" => "العنوان مطلوب",
            "title.string" => "العنوان يجب ان يكون نص",
            "title.max" => "العنوان يجب ان لا يتجاوز 255 حرف",
            "price.required" => "السعر مطلوب",
            "price.numeric" => "السعر يجب ان يكون رقم",
            "model.required" => "الموديل مطلوب",
            "year.required" => "السنة مطلوبة",
            "km.required" => "الكيلومترات مطلوبة",
            "body_type.required" => "نوع الهيكل مطلوب",
            "mechanical_condition.required" => "الحالة الميكانيكية مطلوبة",
            "regional_specifications.required" => "المواصفات الإقليمية مطلوبة",
            "car_conditions.required" => "حالة السيارة مطلوبة",
            "seller_type.required" => "نوع البائع مطلوب",
            "transmission.required" => "نوع الناقل مطلوب",
            "engine_power.required" => "قوة المحرك مطلوبة",
            "insurance.required" => "التأمين مطلوب",
            "outer_color.required" => "اللون الخارجي مطلوب",
            "inner_color.required" => "اللون الداخلي مطلوب",
            "door_numbers.required" => "عدد الابواب مطلوب",
            "seat_numbers.required" => "عدد المقاعد مطلوب",
            "cylinders.required" => "عدد السلندرات مطلوب",
            "fuel_type.required" => "نوع الوقود مطلوب",
            "technical_features.required" => "المواصفات الفنية مطلوبة",
            "driving_hand.required" => "نوع الدفع مطلوب",
            "additional_features.required" => "المواصفات الاضافية مطلوبة",
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

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $user = $builder->find($id);
        if ($user) {
            $user->delete();
            return __("Ad deleted successfully");
        }

        return false;
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
        $data["user_id"] = auth()->id();
        $data["status"] = "new";
        $data['additional_features'] = json_encode($data['additional_features']);

        $car = $builder->create($data);

        if ($car) {
            return __("Ad created successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $car = $builder->find($id);
        $data['additional_features'] = json_encode($data['additional_features']);

        if ($car) {
            $car->update($data);
            return __("Ad updated successfully");
        }

        return false;
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
        return __($this->model);
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
        return __($this->body_type);
    }

    public function getMechanicalConditionNameAttribute()
    {
        return __($this->mechanical_condition);
    }

    public function getSellerTypeNameAttribute()
    {
        return __($this->seller_type);
    }

    public function getTransmissionNameAttribute()
    {
        return __($this->transmission);
    }

    public function getEnginePowerNameAttribute()
    {
        return __($this->engine_power);
    }

    public function getStatusNameAttribute()
    {
        return __($this->status);
    }

    public function getAdditionalFeaturesArrayAttribute($value)
    {
        return json_decode($this->additional_features);
    }
}
