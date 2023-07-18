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
        'name',
        'email',
        'password',
        'phone',
        'type',
        'email_verified_at',
        'status',
        'code'
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
            'name',
            'email',
            'password',
            'phone',
            'type',
            'status',
            'email_verified_at',
            // 'code'
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

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
            'type' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['type'] != null, function ($query) use ($filters) {
            $query->where('type', $filters['type']);
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->where('status', $filters['status']);
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
            'type' => 'required|in:admin,seller,buyer',
            'password' => 'required|string|min:8',
        ];
    }

    public function scopeGetMessages()
    {
        return [
            'name.required' => 'اسم المستخدم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني يجب ان يكون بريد الكتروني',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل',
            'type.required' => 'نوع المستخدم مطلوب',
            'type.in' => 'نوع المستخدم يجب ان يكون من الاختيارات المتاحة',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'يجب ان تكون كلمة المرور مكونة من 8 رموز'
        ];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $user = $builder->find($id);
        if ($user) {
            $user->delete();
            return "تم حذف المستخدم بنجاح";
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
            return "تم تغير حالة المستخدم بنجاح";
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
            return "تم اضافة المستخدم بنجاح";
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
            return "تم تعديل المستخدم بنجاح";
        }

        return false;
    }
}
