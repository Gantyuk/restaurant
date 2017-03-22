<?php

namespace App\Http\Controllers;

use App\Mark;
use App\Restaurant;
use App\User;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function add_mark(Request $request)
    {
        $marks = Mark::all();
        $Mark = new Mark();
        foreach ($marks as $mark){
            if(($mark->user_id == $request['user_id'])&& ($mark->restaurant_id == $request['restaurant_id'])){
                $Mark = $mark;
            }
        }
        $user = User::find($request['user_id']);
        $restaurant = Restaurant::find($request['restaurant_id']);
        $Mark->mark = $request['mark'];
        $Mark->user_id = $request['user_id'];
        $Mark->restaurant_id = $request['restaurant_id'];

        $Mark->restaurant($restaurant);
        $Mark->user($user);
        $Mark->save();
    }
}
