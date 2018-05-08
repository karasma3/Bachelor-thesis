<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

/**
 * Class TeamController
 *
 * @package App\Http\Controllers
 */
class TeamController extends Controller
{
    public function __construct(){
//        $this->middleware('guest', ['only' => 'index', 'show']);
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
    public function delete(Team $team){
        return view('teams.delete', compact('team'));
    }
    public function inactivateTeam(Team $team){
        $team->activate(false);
        return redirect('/teams/'.$team->id);
    }
    /**
     * Store method - validates Team name
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(){
        $player = Player::where('email',request('email'))->first();
        if($player) {
            $user = Auth::user();
            $team = Team::create([
                'team_name' => $user->surname . '/' . $player->surname,
                'player_id_first' => $user->id,
                'player_id_second' => $player->id,
                'singles' => false
            ]);
            session()->flash('message','Tím bol vytvorený!');
        }
        else{
            session()->flash('fail','Hráč s emailom '.request('email').' nebol nájdený!');
        }
        return redirect('/');
    }
}
