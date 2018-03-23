<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'index', 'show']);
    }
    public function index(){
        $teams = Team::all();

        return view('teams.index', compact('teams'));
    }
    public function show(Team $team){

        return view('teams.show', compact('team'));
    }
    public function create(){

        return view('teams.create');
    }
    public function edit(Team $team){

        return view('teams.edit', compact('team'));
    }
    public function store(){

        $this->validate(request(),[
            'team_name' => 'required|unique:teams|min:3|max:20|string'
        ]);
        $team =Team::create( [
            'team_name' => request('team_name')
        ]);

        $player = Player::find(auth()->user()->id);
        $team->players()->attach($player->id);

        return redirect('/');
    }
}
