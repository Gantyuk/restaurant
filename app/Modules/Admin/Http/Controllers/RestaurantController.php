<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Address;
use App\Category;
use App\CategoryRestaurant;
use App\Document;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestorant;
use App\Image;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function show()
    {
        $model = Restaurant::paginate(20);
        return view('admin::restaurant.show', ['model' => $model]);
    }

    public function create()
    {
        $category = Category::select('id', 'name')->get();

        return view('admin::restaurant.create', ['category' => $category]);
    }


    public function store(StoreRestorant $request)
    {
        $restaurant = Restaurant::create($request->all());
        foreach ($request->category as $category) {

            CategoryRestaurant::create([
                    'restaurant_id' => $restaurant->id,
                    'category_id' => $category
                ]
            );
        }
        $image = $request->file('image');
        $image_path = 'img/restaurants/';
        $this->saveFiles(Image::class, $image, $restaurant->id, $image_path);
        $menu = $request->file('menu');
        $menu_path = 'img/restaurants/menu/';
        $this->saveFiles(Document::class, $menu, $restaurant->id, $menu_path);
//            foreach ($request->address as $address){
//                Address::create($address->all());
//            }

    }

    private function saveFiles($model, $file, $id, $path)
    {
        foreach ($file as $img) {
            $extends = $img->getClientOriginalExtension();
            $name = $this->uniqueFileName($model, $extends, $path);
            $img->move($path, $name);
            $model::create([
                'path' => $path . $name,
                'restaurant_id' => $id,
                'type' => $extends,
            ]);

        }
    }

    private function uniqueFileName($obj, $extends, $path)
    {
        $file_name = $path . str_random(30) . "." . $extends;
        $name = $obj::where('path', $file_name)->get();
        if ($name->isEmpty()) {
            return $file_name;
        } else {
            $this->uniqueFileName();
        }
    }
}
