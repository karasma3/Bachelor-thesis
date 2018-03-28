<?php

namespace App\Http\Controllers;

use App\Models\Elimination;
use App\Models\Group;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\Match;

class MatchController extends Controller
{
    public function index(){
        $matches = Match::all();

        return view('matches.index', compact('matches'));
    }
    public function show(Match $match){

        return view('matches.show', compact('match'));
    }
    public function edit(Match $match){

        return view('matches.edit', compact('match'));
    }
    public function store(Team $team1, Team $team2, Group $group, Elimination $elimination){

        $match = Match::create()([
        ]);

        $match = $team1->matches()->save($match);
        $match = $team2->matches()->save($match);
        if($group) $match = $group->matches()->save($match);
        if($elimination) $match = $elimination->matches()->save($match);
    }
}
