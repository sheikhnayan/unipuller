<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class star extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type','details','is_active','image_url','image_folder','image_name'];

}
