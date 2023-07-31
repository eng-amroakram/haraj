<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $fillable = [
        'name_ar',
        'name_en',
        'status',
    ];

    public function scopeData($query)
    {
        return $query->select('id', 'name_ar', 'name_en', 'status', 'created_at', 'updated_at');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeFilters(Builder $builder, array $filters)
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

    public function scopeGetRules(Builder $builder, $id = '')
    {
        return [
            'name_ar' => 'required|string|max:255|unique:cities,name_ar,' . $id,
            'name_en' => 'required|string|max:255|unique:cities,name_en,' . $id,
        ];
    }

    public function scopeGetMessages()
    {
        return [
            'name_ar.required' => __('This field is required'),
            'name_ar.unique' => __('This field is already exists'),
            'name_en.required' => __('This field is required'),
            'name_en.unique' => __('This field is already exists'),
        ];
    }


    public function scopeStatus(Builder $builder, $id)
    {
        $model = $builder->find($id);

        if ($model) {

            $model->update([
                'status' => $model->status == "active" ? "inactive" : "active"
            ]);

            return __("City status updated successfully");
        }

        return false;
    }

    public function scopeStore(Builder $builder, $data)
    {
        $data['status'] = "active";

        $model = $builder->create($data);

        if ($model) {
            return __("City created successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $model = $builder->find($id);

        if ($model) {
            $model->update($data);

            return __("City updated successfully");
        }

        return false;
    }
}
