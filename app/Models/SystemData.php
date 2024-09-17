<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemData extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value'];
}
