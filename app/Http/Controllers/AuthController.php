<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function register(){

        return view('auth.create');
    }
    public function login(){

        return view('auth.login');
    }
    public function storeLogin(){

        if(! auth()->attempt(request(['email','password']))){

            return redirect()->back()->withErrors([
                'message' => 'Try again, bad credentials.'
            ]);
        }

        return redirect()->home();
    }
    public function storeRegister(){

        //validate the form
        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        //create and save player
        $player = Player::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'email' => request('email'),
            'password'=> bcrypt(request('password'))
        ]);
        //sign in
        auth()->login($player);
        //redirect to home page
        return redirect()->home();
    }
    public function logout(){
        auth()->logout();
        return redirect()->home();
    }
}
