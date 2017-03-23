<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends \Eloquent
{
    protected $fillable = ['name'];
    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurant', 'category_restaurants', 'category_id', 'restaurant_id')->withTimestamps();

    }
}
