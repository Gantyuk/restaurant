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
        foreach ($restaurants as $restaurant):
            $mark["$restaurant->id"] = $restaurant->marks->avg('mark');
            $img["$restaurant->id"] = $restaurant->images;
            $category["$restaurant->id"] = CategoryRestaurant::where('restaurant_id', $restaurant->id)->get();
        endforeach;
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
        $path_img = $restaurant->images;
        $mark = $restaurant->marks->avg('mark');
        $comments = $restaurant->comments;
        return view('restaurants.restaurant', compact('restaurant', 'path_img', 'mark', 'comments'));
    }
    public function restaurant_top()
    {
        $restaurants = Restaurant::where('visible', 1)->get();
        foreach ($restaurants as $restaurant):
            $mark["$restaurant->id"] = $restaurant->marks->avg('mark');;
        endforeach;
        uasort($mark, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? -1 : 1;
        });
        $mark = array_chunk($mark, 10, true);
        $mark = $mark[0];
        foreach ($mark as $key => $value):
            $topRestoran[$key] = Restaurant::where('visible', 1)->where('id', $key)->get();
            $img["$key"] = Image::find($key);
            $category["$key"] = CategoryRestaurant::where('restaurant_id', $key)->get();
        endforeach;
        foreach ($category as $categ):
            $i = 0;
            foreach ($categ as $cat):
                $catProm[$i] = Category::where('id', $cat->category_id)->get();
                $i++;
            endforeach;
            $categoriesRestaurant["$cat->restaurant_id"] = $catProm;
            unset($catProm);
        endforeach;
        $i = 1;
        return view('restaurants.top_10', compact('topRestoran', 'mark', 'img', 'categoriesRestaurant', 'i'));
    }
}