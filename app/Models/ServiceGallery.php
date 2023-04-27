<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceGallery extends Model
{
    protected $fillable = ['service_id','photo'];
    public $timestamps = false;
}
