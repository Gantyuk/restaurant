<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Comment;
use App\Mark;
use App\Restaurant;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {

        $count['user'] = User::pluck('id')->count();
        $count['restaurant'] = Restaurant::pluck('id')->count();
        $count['last_week'] = User::where('created_at','>',Carbon::today()->subWeek())->count();
        $count['comments'] = Comment::where('created_at','>',Carbon::today()->subWeek())->count();
        $count['marks'] = Mark::where('created_at','>',Carbon::today()->subWeek())->count();
//        dd(Carbon::today()->subWeek());
        return view('admin::index',['count'=>$count]);
    }
    public function map()
    {


        return view('admin::helpers.map2');
    }
}
