<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
