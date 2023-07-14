<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'car_id',
        'status',
        'price',
        'description',
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'buyer_id',
            'seller_id',
            'car_id',
            'status',
            'price',
            'description',
            'created_at',
            'updated_at',
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->whereHas('buyer', function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['search'] . '%');
            })->orWhereHas('seller', function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['search'] . '%');
            });
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function getBuyerNameAttribute()
    {
        return $this->buyer->name;
    }

    public function getSellerNameAttribute()
    {
        return $this->seller->name;
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getStatusNameAttribute($value)
    {
        return __($this->status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeByCar($query, $car)
    {
        return $query->where('car_id', $car->id);
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'buyer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id|exists:cars,user_id',
            'car_id' => 'required|exists:cars,id',
            // 'status' => 'required|in:pending,accepted,rejected',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ];
    }

    public function scopeGetMessages(Builder $builder)
    {
        return [];
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $offer = $builder->find($id);
        if ($offer) {
            $offer->delete();
            return __("Offer deleted successfully");
        }

        return false;
    }

    public function scopeStore(Builder $builder, $data)
    {
        $data['status'] = 'pending';

        $offer = $builder->create($data);
        if ($offer) {
            return __("Offer created successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $offer = $builder->find($id);

        if ($offer) {
            $offer->update($data);
            return __("Offer updated successfully");
        }

        return false;
    }
}
