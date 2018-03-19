<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class TournamentController extends Controller
{
    public function index(){
        $players = Player::all();

        return view('players.index', compact('players'));
    }
    public function show($id){
        $players = Player::find($id);

        return view('players.show', compact('players'));
    }
}
