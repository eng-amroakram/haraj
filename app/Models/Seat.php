<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'status'
    ];

    public function scopeData($query)
    {
        return $query->select(['id', 'name_ar', 'name_en', 'status']);
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'name_ar' => 'required|unique:seats,name_ar,' . $id,
            'name_en' => 'required|unique:seats,name_en,' . $id,
        ];
    }

    public function scopeGetMessages($id = "")
    {
        return [
            'name_ar.required' => __('Seat Name is required'),
            'name_ar.unique' => __('Seat Name is already exists'),
            'name_en.required' => __('Seat Name is required'),
            'name_en.unique' => __('Seat Name is already exists'),
        ];
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name_ar', 'like', '%' . $filters['search'] . '%')
                ->orWhere('name_en', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function scopeDeleteModel(Builder $builder, $id)
    {
        $model = $builder->find($id);

        if ($model) {
            $model->delete();

            return __("Seat deleted successfully");
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $model = $builder->find($id);

        if ($model) {

            $model->update([
                'status' => $model->status == "active" ? "inactive" : "active"
            ]);

            return __("Seat status changed successfully");
        }

        return false;
    }

    public function scopeStore(Builder $builder, $data)
    {
        $data['status'] = "active";

        $model = $builder->create($data);

        if ($model) {
            return __("Seat created successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $model = $builder->find($id);

        if ($model) {
            $model->update($data);

            return __("Seat updated successfully");
        }

        return false;
    }
}
