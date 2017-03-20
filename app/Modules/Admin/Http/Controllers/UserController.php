<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search != null) {
            $user = User::where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', "%$request->search%")->paginate(20);
        } else {
            $user = User::paginate(20);
        }
        return view('admin::user.show', ['user' => $user]);
    }
    public function logout(){
        \Auth::logout();
     return   redirect('/');
    }

    public function ban(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->ban) {
            $user->ban = 1;
            $user->save();
        } else {
            $user->ban = 0;
            $user->save();
        }
    }
}
