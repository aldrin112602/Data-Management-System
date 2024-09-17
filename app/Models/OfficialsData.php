<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialsData extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'province_id',
        'municipality_id',
        'official_image',
        'description',
    ];

    // Define the relationship with ProvincialData
    public function province()
    {
        return $this->belongsTo(ProvincialData::class, 'province_id');
    }

    // Define the relationship with MunicipalData
    public function municipality()
    {
        return $this->belongsTo(MunicipalData::class, 'municipality_id');
    }
}
