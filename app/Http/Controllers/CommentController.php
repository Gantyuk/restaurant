<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Restaurant;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add_comment(Request $request)
    {
        $comment = new Comment();
        $restaurant = Restaurant::find($request['restaurant_id']);
        $user = User::find($request['user_id']);
        $comment->comment = $request['comment'];
        $comment->restaurant_id = $request['restaurant_id'];
        $comment->user_id = $request['user_id'];

        $restaurant->comments()->save($comment);
        $user->comments()->save($comment);

        $comment->save();
        return redirect()->route('view_restaurant', ['id' => $request['restaurant_id']]);
    }
}
