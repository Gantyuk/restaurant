<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'day','start','end','restaurant_id'
    ];
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
