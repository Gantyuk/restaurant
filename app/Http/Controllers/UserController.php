<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authentication(Request $request)
    {
       if( Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']])){
           return redirect('/');
       }
       return redirect()->back();
    }
    public function registration(Request $request)
    {
        $user = new User();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);

        $file = $request->file('image');
        $file_name = str_random(30).'.jpg';
        $file->move('../files', $file_name);
        $user->path_img = 'files/'.$file_name;

        $user->save();
        return redirect()->route('authentication');
    }
}
