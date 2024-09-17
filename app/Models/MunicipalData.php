<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipalData extends Model
{
    use HasFactory;

    protected $fillable = [
        'municipal_name',
        'province_id',
        'municipal_logo',
        'description',
    ];

    // Define the relationship with ProvincialData
    public function province()
    {
        return $this->belongsTo(ProvincialData::class, 'province_id');
    }

    // Define the relationship with OfficialsData
    public function officials()
    {
        return $this->hasMany(OfficialsData::class, 'municipality_id');
    }
}
