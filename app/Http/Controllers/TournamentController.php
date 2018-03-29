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
    public function join(Tournament $tournament){
        return view('tournaments.join', compact('tournament'));
    }
    public function addPlayer(Tournament $tournament){
        if(auth()->check())
            $tournament->teams()->attach(request('team_name'));
        return redirect('/tournaments/'.$tournament->id);
    }
    public function show(Tournament $tournament){

        return view('tournaments.show', compact('tournament'));
    }
    public function store(){

    }
}
