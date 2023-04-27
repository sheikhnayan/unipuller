<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserShop extends Model
{
    protected $fillable = ['category_id', 'subcategory_id', 'country', 'user_id', 'shop_name','shop_image','shop_banner','shop_about','shop_number','shop_address', 'owner_name', 'email', 'phone', 'reg_number','language_id', 'website', 'facebook', 'instagram', 'linkedin', 'twitter', 'youtube', 'pinterest', 'status'];

    public $timestamps = false;


    public function language()
    {
    	return $this->belongsTo('App\Models\Language','language_id')->withDefault();
    }
    
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id','id');
    }
    
    public function services(){
        return $this->hasMany('App\Models\UserService','shop_id','id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product','shop_id','id');
    }

}