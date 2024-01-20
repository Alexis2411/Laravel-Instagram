<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        $user =\Auth::user();
        $id = $user->id;

        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick, '.$id],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email, '.$id],
        ]);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        $user->name =$name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        $image_path =$request->file('image_path');
        if ($image_path){
           $image_path_full= time().$image_path->getClientOriginalName();
           Storage::disk('users')->put($image_path_full, file_get_contents($image_path));
           $user->image = $image_path_full;
        }

        $user->update();

        return redirect()->back()->with(['message'=>'usuario actualizado']);

    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
