<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Class PlayerController
 *
 * @package App\Http\Controllers
 */
class PlayerController extends Controller
{
    public function index(){
        $players = Player::all();

        return view('players.index', compact('players'));
    }
    public function show(Player $player){

        return view('players.show', compact('player'));
    }

    public function edit(Player $player){

        return view('players.edit', compact('player'));
    }

    /**
     * Method for editing player - validates name, surname and email after that it updates Player
     *
     * @param Player $player
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editPlayer(Player $player){
        $this->validate(request(),[
            'name' => 'required|string|min:0|max:20',
            'surname' => 'required|string|min:0|max:20',
            'email' => 'required|email|unique:players'
        ]);
        $player->name = request('name');
        $player->surname = request('surname');
        $player->email = request('email');
        $player->save();
        session()->flash('message','Your profile was updated!');
        return redirect('/players/'.$player->id);
    }

    /**
     * Method for changing the current password - checks for current password and validates the new password
     *
     * @param Player $player
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changePassword(Player $player){

        $this->validate(request(),[
            'current-password' => 'required',
            'password' => 'required|confirmed'
        ]);

        if(!Hash::check(request('current-password'),Auth::user()->password)){
            session()->flash('fail','You typed your current password invalid!');
        }
        else {
            $player->password = Hash::make(request('password'));
            $player->save();
            session()->flash('message', 'Your password was successfully changed!');
        }
        return redirect('/players/'.$player->id);
    }
    public function store(){

    }
}
