<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street','house','lat','lng','restaurant_id',
    ];
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
