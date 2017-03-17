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
        $restaurants = Restaurant::where('visible', 1)->paginate(5);
        $mark = [];
        $category = [];
        foreach ($restaurants as $restaurant):
            $mark["$restaurant->id"] = Mark::where('restaurant_id', $restaurant->id)->avg('mark');
            $img["$restaurant->id"] = Image::find($restaurant->id);
            $category["$restaurant->id"] = CategoryRestaurant::where('restaurant_id', $restaurant->id)->get();
        endforeach;
        $categoriesRestaurant= [];
        foreach ($category as $categ):
            $i=0;
            foreach ($categ as $cat):
                $catProm[$i]= Category::where('id', $cat->category_id)->get();
                $i++;
            endforeach;
            $categoriesRestaurant["$cat->restaurant_id"] =$catProm;
            unset($catProm);
        endforeach;
        return view('restaurants.restaurants', compact('restaurants', 'img', 'mark', 'categoriesRestaurant'));
    }

    public function restaurant($id)
    {
        $restaurant = Restaurant::find($id);
        $path_img = Image::where('restaurant_id', $id)->get();
        $mark = Mark::where('restaurant_id', $id)->avg('mark');
        return view('restaurants.restaurant', compact('restaurant', 'path_img', 'mark'));
    }
}
