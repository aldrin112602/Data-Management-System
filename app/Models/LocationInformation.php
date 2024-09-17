<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'address',
        'province_id',
        'municipality_id',
        'owner',
        'description',
        'latitude',
        'longitude',
        'image'
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
