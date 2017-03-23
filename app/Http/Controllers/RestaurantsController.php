<?php
namespace App\Http\Controllers;

use App\Category;
use Barryvdh\Reflection\DocBlock\Type\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class RestaurantsController extends Controller
{
    public function index()
    {

        if (isset($_GET['startFrom'])) {
            $startFrom = $_GET['startFrom'];
// Получаем 10 статей, начиная с последней отображеннойleftJoin('images', 'restaurants.id', '=', 'images.restaurant_id')
            $restaurants = Restaurant::where('visible', 1)->offset($startFrom)->limit(6)->get();
// Превращаем массив статей в json-строку для передачи через Ajax-запрос
            $data = [];
            $img = [];
            $address = [];
            $mark = [];
            foreach ($restaurants as $restaurant):
                $img[$restaurant->id] = $restaurant->images[0]->path;
                foreach ($restaurant->addresses as $addres)
                    $address[$restaurant->id] = $addres->street . ',' . $addres->house;
                $mark[$restaurant->id] = $restaurant->marks->avg('mark');
            endforeach;

            $data['restaurants'] = $restaurants;
            $data['img'] = $img;
            $data['address'] = $address;
            $data['mark'] = $mark;
            echo json_encode($data);
        } else {
            $restaurants = Restaurant::where('visible', 1)->limit(6)->get();
            return view('restaurants.restaurants', compact('restaurants'))->with(['categories' => ""]);
        }
    }

    public function restaurant($id)
    {
        @$restaurant = Restaurant::find($id) or
        die (view('ERROR'));
        $comments = $restaurant->comments->where('parent_id', 0);
        $user = Auth::user();
        if ($user != false) {
            $mark = $restaurant->marks->where('user_id', $user->id)->first();
            if ($mark != null)
                $mark = $mark->mark;
            else
                $mark = 0;
        } else
            $mark = 0;
        return view('restaurants.restaurant', compact('restaurant', 'comments', 'mark'));
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
        if (isset($_GET['startFrom'])) {
            $startFrom = $_GET['startFrom'];
// Получаем 10 статей, начиная с последней отображеннойleftJoin('images', 'restaurants.id', '=', 'images.restaurant_id')
            $categories = Category::find($id);
            $restaurants = $categories->restaurants()->offset($startFrom)->limit(6)->get();
// Превращаем массив статей в json-строку для передачи через Ajax-запрос
            $data = [];
            $img = [];
            $address = [];
            $mark = [];
            foreach ($restaurants as $restaurant):
                $img[$restaurant->id] = $restaurant->images[0]->path;
                foreach ($restaurant->addresses as $addres)
                    $address[$restaurant->id] = $addres->street . ',' . $addres->house;
                $mark[$restaurant->id] = $restaurant->marks->avg('mark');
            endforeach;

            $data['restaurants'] = $restaurants;
            $data['img'] = $img;
            $data['address'] = $address;
            $data['mark'] = $mark;
            echo json_encode($data);
        } else {
            $categories = Category::find($id);
            $entries = $categories->restaurants()->limit(6)->get();
            return view('restaurants.restaurants')->with(['restaurants' => $entries])->with(['categories' => $categories->name]);
        }


    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required']);
        if (isset($_GET['startFrom'])) {
            $startFrom = $_GET['startFrom'];
// Получаем 10 статей, начиная с последней отображеннойleftJoin('images', 'restaurants.id', '=', 'images.restaurant_id')
            $restaurants = Restaurant::where('visible', 1)->where('name', 'like', '%' . $$request['search'] . '%')
                ->offset($startFrom)->limit(6)->get();
// Превращаем массив статей в json-строку для передачи через Ajax-запрос
            $data = [];
            $img = [];
            $address = [];
            $mark = [];
            foreach ($restaurants as $restaurant):
                $img[$restaurant->id] = $restaurant->images[0]->path;
                foreach ($restaurant->addresses as $addres)
                    $address[$restaurant->id] = $addres->street . ',' . $addres->house;
                $mark[$restaurant->id] = $restaurant->marks->avg('mark');
            endforeach;

            $data['restaurants'] = $restaurants;
            $data['img'] = $img;
            $data['address'] = $address;
            $data['mark'] = $mark;
            echo json_encode($data);
        } else {
            $restaurants = Restaurant::where('visible', 1)->where('name', 'like', '%' . $request['search'] . '%')
                ->limit(6)->get();
            return view('restaurants.restaurants', compact('restaurants'))->with(['categories' => ""]);
       }

    }
}