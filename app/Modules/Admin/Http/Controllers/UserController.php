<?php

namespace App\Modules\Admin\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(20);
       return view('admin::user.show',['user'=>$user]);
    }

    public function ban(Request $request,$id)
    {
        $user = User::find($id);
        if($request->ban){
            $user->ban = 1;
            $user->save();
        }else{
            $user->ban = 0;
            $user->save();
        }
    }
}
