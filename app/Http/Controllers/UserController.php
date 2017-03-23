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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = new User();
        $user->first_name =ucfirst( $request['first_name']);
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();
        return redirect()->route('authentication');
    }

    public function log_out()
    {
        Auth::logout();
        return redirect('/');
    }

    public function profile($id)
    {
        return view('profile')->with(['user' => User::find($id)]);
    }

    public function profileUser($id)
    {
        return view('UserProfail')->with(['user' => User::find($id)]);
    }

    public function update_profile(Request $request)
    {
       $this->validate($request, [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
        ]);
        $user = User::find($request['id']);
            $user->first_name = ucfirst($request['first_name']);
            $user->last_name = ucfirst($request['last_name']);

        if ($request->file('image') != '') {

        $file = $request->file('image');
        $file_name = str_random(30) . '.jpg';
        $file->move('img/users/', $file_name);
        $user->path_img = '/img/users/' . $file_name;
    }


    if(($request['passwd'] != '')&&($request['new_passwd'] != '')&&($request['repeat_new_passwd'] != '')){

            if($request['passwd'] == $user->password){
                if($request['new_passwd'] == $request['repeat_new_passwd'] ){
                    $user->password = $request['new_passwd'];
                }
                else{
                    return redirect()->back();
                }
            }
            else{
                return redirect()->back();
            }
    }
        $user->save();
        return redirect('/');
    }


    public function marks($id)
    {
        $user = User::find($id);
        $marks = $user->marks;
       return view('marks')->with(['marks' => $marks]);
    }
    public function comments($id)
    {
        $user = User::find($id);
        $comments = $user->comments;
        return view('comments')->with(['comments' => $comments]);
    }
}
