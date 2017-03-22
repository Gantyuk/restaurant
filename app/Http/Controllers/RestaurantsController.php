<?php
namespace App\Http\Controllers;

use App\Category;
use Barryvdh\Reflection\DocBlock\Type\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Restaurant;

class RestaurantsController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::where('visible', 1)->paginate(6);
        return view('restaurants.restaurants', compact('restaurants'))->with(['categories' => ""]);
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
        $categories = Category::find($id);
        $entries = $categories->restaurants()->paginate(6);
        return view('restaurants.restaurants')->with(['restaurants' => $entries])->with(['categories' => $categories->name]);
    }
}