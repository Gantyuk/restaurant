<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable=[
        'path','restaurant_id','type'
    ];
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
