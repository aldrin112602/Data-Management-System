<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvincialData extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_name',
        'province_logo',
        'description',
    ];

    // Define the relationship with MunicipalData
    public function municipalities()
    {
        return $this->hasMany(MunicipalData::class, 'province_id');
    }
    
}
