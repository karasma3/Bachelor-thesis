<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Team;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
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

    /**
     * Authentication of Player while logging in
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function storeLogin(){

        if(! auth()->attempt(request(['email','password']))){

            return redirect()->back()->withErrors([
                'message' => 'Try again, bad credentials.'
            ]);
        }

        return redirect()->home();
    }

    /**
     * Registering new Player
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeRegister(){

        //validate the form
        $this->validate(request(),[
            'name' => 'required|string|min:0',
            'surname' => 'required|string|min:0',
            'email' => 'required|email|unique:players',
            'password' => 'required|confirmed'
        ]);
        //create and save player
        $player = Player::create([
            'name' => request('name'),
            'surname' => request('surname'),
            'email' => request('email'),
            'password'=> bcrypt(request('password'))
        ]);
        $team = Team::create([
            'team_name' => $player->name.' '.$player->surname,
            'player_id_first' => $player->id
        ]);
        //sign in
        auth()->login($player);
        session()->flash('message','You have been registered!');
        //redirect to home page
        return redirect()->home();
    }
    public function logout(){
        auth()->logout();
        return redirect()->home();
    }
}
