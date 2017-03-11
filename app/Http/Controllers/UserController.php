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
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = new User();
        $user->first_name =ucfirst( $request['first_name']);
        $user->last_name = ucfirst($request['last_name']);
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);

        $file = $request->file('image');
        $file_name = str_random(30).'.jpg';
        $file->move('../files', $file_name);
        $user->path_img = 'files/'.$file_name;

        $user->save();
        return redirect()->route('authentication');
    }

    public function log_out()
    {
        Auth::logout();
        return redirect('/');
    }

}
