<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationData extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_type',
        'location_logo',
        'description',
    ];
}
