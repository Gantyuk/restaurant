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

    public function around($lat,$lng)
    {
        $restaurant = \DB::select('SELECT * , ( 6371 * acos( cos( radians(' . $lat . ') ) 
            * cos( radians( addresses.lat ) ) * cos( radians( addresses.lng ) - radians(' . $lng . ') ) 
            + sin( radians(' . $lat . ') ) * sin( radians( addresses.lat ) ) ) ) AS distance 
            FROM addresses HAVING distance < 1 ORDER BY distance LIMIT 0 , 20;');
        return $restaurant;
    }



}
