<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function create_address(Request $request)
    {

        $map_address = "$request->address ,Чернівці, Чернівецька область,Україна";
        $url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=" . urlencode($map_address) . '&language=ru';
        $lat_long = get_object_vars(json_decode(file_get_contents($url)));
        $array['lat'] = $lat_long['results'][0]->geometry->location->lat;
        $array['lng'] = $lat_long['results'][0]->geometry->location->lng;
        $array['house'] = $lat_long['results'][0]->address_components[0]->long_name;
        $array['street'] = $lat_long['results'][0]->address_components[1]->long_name;
        return $array;

    }


}
