<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Category;
use App\Restaurant;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{

    public function create()
    {
        $category = Category::select('id','name')->get();

        return view('admin::restaurant.create',['category'=>$category]);
    }

    public function store(Request $request)
    {
     $restaurant =   Restaurant::create($request->all());
        $file = $request->file('image');
        print_r($file[0]);
        $file_name = str_random(30).'.jpg';
        $file->move('../files', $file_name);
//        $user->path_img = 'files/'.$file_name;
    }
}
