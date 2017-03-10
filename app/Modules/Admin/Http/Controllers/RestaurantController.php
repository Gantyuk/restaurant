<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{

    public function create()
    {
        return view('admin::restaurant.create');
    }

    public function store(Request $request)
    {

    }
}
