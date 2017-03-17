<?php

namespace App\Http\Controllers;


use App\Category;
use App\CategoryRestaurant;
use App\Image;
use App\Mark;
use Illuminate\Support\Collection;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::where('visible',1)->paginate(5);
        $mark = [];
        $category = [];
        foreach ($restaurants as $restaurant):
            $mark["$restaurant->id"] = Mark::where('restaurant_id', $restaurant->id)->avg('mark');
            $img["$restaurant->id"] = Image::find($restaurant->id);
            $category["$restaurant->id"] = CategoryRestaurant::where('restaurant_id', $restaurant->id);
        endforeach;
        $mas = [];
        foreach ($category as $categ)
            foreach ($categ as $cat)
            $mas["$categ->id"] = Category::where('restaurant_id', $cat->category_id);

        return view('restaurants.restaurants', compact('restaurants', 'img', 'mark','category'));
    }

    public function restaurant($id)
    {
        $restaurant = Restaurant::find($id);
        $path_img = Image::where('restaurant_id', $id)->get();
        $mark = Mark::where('restaurant_id', $id)->avg('mark');
        return view('restaurants.restaurant', compact('restaurant', 'path_img','mark'));
    }
}
