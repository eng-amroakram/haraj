<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'images/galleries';

    protected $fillable = [
        "seller_id",
        "name",
        "image",
        "phone",
        "email",
        "brief",
        "commercial_registration_no",

        "princedom_id",
        "city_id",
        "location",
        "street_name",
        "building_number",
        "zip_code",

        "status"
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function scopeData($query)
    {
        return $query->select(
            'id',
            'seller_id',
            'name',
            'image',
            'phone',
            'email',
            'brief',
            'commercial_registration_no',
            "princedom_id",
            "city_id",
            "location",
            "street_name",
            "building_number",
            "zip_code",
            'status'
        );
    }

    public function scopeFilter(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('commercial_registration_no', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'gallery_id', 'id');
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'nullable',
            'phone' => 'required|string|max:255|unique:galleries,phone,' . $id,
            'email' => 'required|string|email|max:255|unique:galleries,email,' . $id,
            'brief' => 'nullable|string|max:500',
            'commercial_registration_no' => 'nullable|string|max:255|unique:galleries,commercial_registration_no,' . $id,
            'princedom_id' => 'required|exists:princedoms,id',
            'city_id' => 'required|exists:cities,id',
            'location' => 'nullable|string|max:255',
            'street_name' => 'nullable|string|max:255',
            'building_number' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function scopeGetMessages()
    {
        return [
            'name.required' => __("This field is required"),
            'phone.required' => __("This field is required"),
            'phone.unique' => __("This phone is already taken"),
            'email.required' => __("This field is required"),
            'email.email' => __("This field must be email"),
            'email.unique' => __("This email is already taken"),
            'brief.max' => __("This field must be less than 500 characters"),
            'commercial_registration_no.max' => __("This field must be less than 255 characters"),
            'commercial_registration_no.unique' => __("This commercial registration no is already taken"),
            'princedom_id.required' => __("This field is required"),
            'princedom_id.exists' => __("This princedom is invalid"),
            'city_id.required' => __("This field is required"),
            'city_id.exists' => __("This city is invalid"),
            'location.max' => __("This field must be less than 255 characters"),
            'street_name.max' => __("This field must be less than 255 characters"),
            'building_number.max' => __("This field must be less than 255 characters"),
            'zip_code.max' => __("This field must be less than 255 characters"),
            'status.required' => __("This field is required"),
            'status.in' => __("This status is invalid"),
        ];
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $user = $builder->find($id);

        if ($user) {
            $user->update([
                'status' => $user->status == 'active' ? 'inactive' : 'active'
            ]);
            return __("Status Changed Successfully");
        }

        return true;
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $data['image'] = $builder->storeFile($data['image']);
        $data['seller_id'] = auth()->id();
        $data['status'] = 'active';

        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        $gallery = $builder->create($data);

        if ($gallery) {
            return __("Gallery Added Successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data)
    {
        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        $gallery = $builder->where('seller_id', auth()->id())->first();

        if ($gallery) {

            $builder->deleteImage($gallery->id);
            $data['image'] = $builder->storeFile($data['image']);


            $gallery->update($data);

            return __("Gallery Updated Successfully");
        }

        return false;
    }
}
