<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSlot extends Model
{
    protected $fillable = ['service_id','day','start_time','end_time'];
    public $timestamps = false;
}
