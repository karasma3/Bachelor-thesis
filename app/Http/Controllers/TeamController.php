<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function index(){
        $teams = Team::all();

        return view('teams.index', compact('teams'));
    }
    public function show(Team $team){

        return view('teams.show', compact('team'));
    }
    public function create(){

        return view('teams.create', compact('team'));
    }
    public function edit(Team $team){

        return view('teams.edit', compact('team'));
    }
    public function store(){

//        dd(request()->all());

        $team = new Team;
    }
}
