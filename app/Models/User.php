<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "name",
        "email",
        "phone",
        "code",
        "image",
        "id_number",
        "nick_name",
        "password",
        "type",
        "status",
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            "name",
            "email",
            "phone",
            "code",
            "image",
            "id_number",
            "nick_name",
            "password",
            "type",
            "status",
            'email_verified_at',
        ]);
    }

    public function getTypeNameAttribute()
    {
        return __($this->type);
    }

    public function favoriteAds()
    {
        return $this->belongsToMany(Car::class, 'ads_user_favorite', 'user_id', 'car_id', 'id', 'id');
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'seller_id');
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
            'type' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('nick_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('id_number', 'like', '%' . $filters['search'] . '%');

        });

        $builder->when($filters['search'] == '' && $filters['type'] != null, function ($query) use ($filters) {
            $query->whereIn('type', $filters['type']);
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function getIsVerifyAttribute()
    {
        return $this->email_verified_at ?  true : false;
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:255|unique:users,phone,' . $id,
            'id_number' => 'required|string|max:255|unique:users,id_number,' . $id,
            'nick_name' => 'required|string|max:255|unique:users,nick_name,' . $id,
            'image' => 'nullable',
            'type' => 'required|in:admin,seller,buyer',
            'password' => 'required|string|min:8',
        ];
    }

    public function scopeGetMessages()
    {
        return [
            'name.required' => __("This field is required"),
            'email.required' => __("This field is required"),
            'email.email' => __("This field must be email"),
            'email.unique' => __("This email is already taken"),
            'phone.required' => __("This field is required"),
            'phone.unique' => __("This phone is already taken"),
            'id_number.required' => __("This field is required"),
            'id_number.unique' => __("This id number is already taken"),
            'type.required' => __("This field is required"),
            'type.in' => __("This type is invalid"),
            'password.required' => __("This field is required"),
            'password.min' => __("This password must be at least 8 characters"),
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $user = $builder->find($id);
        if ($user) {
            $user->delete();
            return __("Deleted successfully");
        }

        return false;
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
        $data = array_merge([
            'name' => '',
            'email' => '',
            'phone' => '',
            'type' => '',
            'password' => '',
        ], $data);

        $user = $builder->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'type' => $data['type'],
            "status" => "active",
            'password' => bcrypt($data['password']),
        ]);

        if ($user) {
            return __("Added successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $user = $builder->find($id);

        if ($user) {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'type' => $data['type'],
                // 'password' => bcrypt($data['password']),
            ]);
            return __("Updated successfully");
        }

        return false;
    }
}
