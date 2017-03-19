<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Restaurant;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {

        $count['user'] = User::pluck('id')->count();
        $count['restaurant'] = Restaurant::pluck('id')->count();
        return view('admin::index',['count'=>$count]);
    }
    public function map()
    {


        return view('admin::helpers.map2');
    }
}
