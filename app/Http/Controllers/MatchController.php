<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\Match;

/**
 * Class MatchController
 * @package App\Http\Controllers
 */
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
    public function store(Team $team1, Team $team2, Group $group){

        $match = Match::create()([
        ]);

        $match = $team1->matches()->save($match);
        $match = $team2->matches()->save($match);
        $group->matches()->save($match);
    }

    /**
     * Method for submitting the final score - validation of scores
     *
     * @param Match $match
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submitScore(Match $match){
        $this->validate(request(),[
            'score_first' => 'required|integer|min:0|max:4',
            'score_second' => 'required|integer|min:0|max:4'
        ]);
        $match->score->score_first = request('score_first');
        $match->score->score_second = request('score_second');
        $match->score->save();
        $match->played = true;
        $match->save();
        session()->flash('message','Your result was given!');
        return redirect('/matches/'.$match->id);
    }
}
