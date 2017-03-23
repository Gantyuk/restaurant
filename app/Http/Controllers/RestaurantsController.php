<?php
namespace App\Http\Controllers;

use App\Category;
use App\CategoryRestaurant;
use App\Image;
use App\Restaurant;

class RestaurantsController extends Controller
{
    public function index()
    {
        $model = Category::where('name','like','%Ресторан з національною специфікою%')->first();
//        dd($model->restaurants()->get());
        $restaurants = Restaurant::where('visible', 1)->paginate(5);

        return view('restaurants.restaurants', compact('restaurants'));
    }

    public function restaurant($id)
    {
        @$restaurant = Restaurant::find($id) or
        die (view('ERROR'));
        $comments = $restaurant->comments->where('parent_id', 0);
        return view('restaurants.restaurant', compact('restaurant','comments'));
    }

    public function restaurant_top()
    {
        $restaurants = Restaurant::where('visible', 1)->get();
        foreach ($restaurants as $restaurant):
            $mark["$restaurant->id"] = $restaurant->marks->avg('mark');
        endforeach;
        @uasort($mark, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? -1 : 1;
        }) or
        die (view('ERROR'));
        $mark = array_chunk($mark, 10, true);
        $mark = $mark[0];
        foreach ($mark as $key => $value):
            $topRestoran[$key] = Restaurant::where('visible', 1)->where('id', $key)->get();
        endforeach;
        $i = 1;
        return view('restaurants.top_10', compact('topRestoran', 'i'));
    }

    public function category($id)
    {
        @$restaurant = Restaurant::find($id) or
        die (view('ERROR'));
        return view('restaurants.restaurant', compact('restaurant'));
    }
}