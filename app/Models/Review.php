<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_text', 
        'rating', 
        'user_name', 
        'address',
        'gender',
        'age',
        'status_type',
        'location_id', 
        'user_unique_id',
        'media_file'
    ];
    

}