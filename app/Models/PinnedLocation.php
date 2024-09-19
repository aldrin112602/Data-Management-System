<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinnedLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'location_id',
        'status',
        'latitude',
        'longitude',
    ];
}
