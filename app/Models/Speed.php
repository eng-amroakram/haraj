<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function scopeData($query)
    {
        return $query->select(['id', 'name', 'status']);
    }
}
