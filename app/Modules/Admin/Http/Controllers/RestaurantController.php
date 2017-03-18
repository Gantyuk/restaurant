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
            $path = $image->path;
            Image::destroy($id);
            if (file_exists(substr($path, 1))&& $path!='/img/default/rest.jpg') {
                unlink(substr($path, 1));
            }
        } elseif ($request->type == 'menu') {
            $doc = Document::find($id);
            $path = $doc->path;
            Document::destroy($id);

            if (file_exists(substr($doc->path, 1)) && $path!='/img/default/rest.jpg') {
                unlink(substr($doc->path, 1));
            }
        }
        if ($request->type == 'address') {
            Address::destroy(substr($image->path, 1));
        }
    }

    public function hiddeRest(Request $request, $id)
    {
        $restaurant = Restaurant::find($id)->first();

        if ($request->visible == 1) {
            Restaurant::where('id',$id)->update(['visible'=>1]);

        } else {
            Restaurant::where('id',$id)->update(['visible'=>0]);

        }


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
        $this->validateUpdate($id);
        return redirect('/');

    }

    public function validateUpdate($id)
    {
        $image = Image::where('restaurant_id',$id)->first();
        if (!count($image)) {
           Image::create([
               'path'=>'/img/default/rest.jpg',
               'restaurant_id'=>$id,
           ]);
        }
        $doc= Document::where('restaurant_id',$id)->first();
        if (!count($doc)) {
           Document::create([
               'type'=>'image',
               'path'=>'/img/default/rest.jpg',
               'restaurant_id'=>$id,
           ]);
        }

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
