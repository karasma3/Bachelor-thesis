<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Player;

class PlayerController extends Controller
{
    public function index(){
        $players = Player::all();

        return view('players.index', compact('players'));
    }
    public function show($id){
        $players = Group::all();

        return view('players.show', compact('players'));
    }
}
