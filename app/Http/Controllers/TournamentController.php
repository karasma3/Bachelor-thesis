<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index(){
        $tournaments = Tournament::all();

        return view('tournaments.index', compact('tournaments'));
    }
    public function create(){

        return view('tournaments.create');
    }
    public function join(Tournament $tournament){
        return view('tournaments.join', compact('tournament'));
    }
    public function addPlayer(Tournament $tournament){
        if(auth()->check())
            $tournament->teams()->attach(request('team_name'));
        session()->flash('message','You were signed in into the TOURNAMENT!');
        return redirect('/tournaments/'.$tournament->id);
    }
    public function show(Tournament $tournament){

        return view('tournaments.show', compact('tournament'));
    }
    public function store(){
        $this->validate(request(),[
            'tournament_name' => 'required|unique:tournaments|min:3|max:20|string'
        ]);
        $tournament = Tournament::create( [
            'tournament_name' => request('tournament_name')
        ]);
        session()->flash('message','Your TOURNAMENT was created!');
        return redirect('/');
    }
}
