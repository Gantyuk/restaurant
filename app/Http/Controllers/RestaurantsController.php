<?php

namespace App\Http\Controllers;

use App\Image;
use App\Mark;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function index()
    {
        $restaurants = DB::table('restaurants')->where('visible',1)->paginate(5);
        $mark = [];
        $img = new Collection();
        foreach ($restaurants as $restaurant):
            $mark["$restaurant->id"] = DB::table('marks')->where('restaurant_id', $restaurant->id)->avg('mark');
          //  $img["$restaurant->id"] = DB::table('images')->where('restaurant_id', $restaurant->id)->first();
        endforeach;
        return view('restaurants.restaurants', compact('restaurants', 'img', 'mark'));
    }

    public function restaurant($id)
    {
        $restaurant = Restaurant::find($id);
        $path_img = DB::table('images')->where('restaurant_id', $id)->get();
        $mark = DB::table('marks')->where('restaurant_id', $id)->avg('mark');
        return view('restaurants.restaurant', compact('restaurant', 'path_img','mark'));
    }
}
