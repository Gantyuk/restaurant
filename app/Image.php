<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends \Eloquent
{
    protected $fillable=[
        'path','restaurant_id'
    ];
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
