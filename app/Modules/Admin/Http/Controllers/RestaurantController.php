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

    public function edit($id)
    {
        $category = Category::select('id', 'name')->get();
        $restaurant = Restaurant::find($id);

        return view('admin::restaurant.edit', ['category' => $category, 'model' => $restaurant]);
    }

    public function delete(Request $request, $id)
    {
        if ($request->type == 'image') {
            $image = Image::find($id);
            if (file_exists(substr($image->path, 1))) {
                unlink(substr($image->path, 1));
            }
            Image::destroy($id);
        } elseif ($request->type == 'menu') {
            $doc = Document::find($id);
            if (file_exists(substr($doc->path, 1))) {
                unlink(substr($doc->path, 1));
            }
            Document::destroy($id);
        }
        if ($request->type == 'address') {
            Address::destroy($id);
        }
    }
    public function hiddeRest(Request $request, $id){
        $restaurant = Restaurant::find($id);
        if($request->visible == true){
            $restaurant->visible=1;
            $restaurant->save();
        }else{
            $restaurant->visible=0;
            $restaurant->save();
        }
        return $id;


    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->update($request->all());
        if ($request->category != null)
            foreach ($request->category as $category) {

                CategoryRestaurant::create([
                        'restaurant_id' => $restaurant->id,
                        'category_id' => $category
                    ]
                );
            }
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_path = '/img/restaurants/';
            $this->saveFiles(Image::class, $image, $restaurant->id, $image_path);
        }
        if (($request->file('menu')) != null) {
            $menu = $request->file('menu');
            $menu_path = '/img/restaurants/menu/';
            $this->saveFiles(Document::class, $menu, $restaurant->id, $menu_path);
        }
        if ($request->address != null)
            foreach ($request->address as $address) {
                Address::create([
                    'street' => $address['street'],
                    'house' => $address['house'],
                    'lat' => $address['lat'],
                    'lng' => $address['lng'],
                    'restaurant_id' => $restaurant->id]);
            }
        return redirect('/');

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
        $image_path = '/img/restaurants/';
        $this->saveFiles(Image::class, $image, $restaurant->id, $image_path);
        $menu = $request->file('menu');
        $menu_path = '/img/restaurants/menu/';
        $this->saveFiles(Document::class, $menu, $restaurant->id, $menu_path);
        foreach ($request->address as $address) {
            Address::create([
                'street' => $address['street'],
                'house' => $address['house'],
                'lat' => $address['lat'],
                'lng' => $address['lng'],
                'restaurant_id' => $restaurant->id]);
        }
        return redirect('/');
    }

    private function saveFiles($model, $file, $id, $path)
    {
        foreach ($file as $img) {
            $extends = $img->getClientOriginalExtension();
            $name = $this->uniqueFileName($model, $extends, $path);

            $model::create([
                'path' => $name,
                'restaurant_id' => $id,
                'type' => $extends,
            ]);
            $img->move(substr($path, 1), $name);

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
