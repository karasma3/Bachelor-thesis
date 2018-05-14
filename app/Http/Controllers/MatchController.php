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
        if(!$match->match_number) {
            $match->group->calculateScore();
            $match->group->calculateOrder();
        }else{
            $round = $match->group->round;
            $count = $match->group->tournament->teams->count();
            $teamLoser = Team::find($match->getLoserId());
            $teamWinner = Team::find($match->getWinnerId());
            if($count > 32 and $round == 1 ){
                $teamLoser->last_placement = 32;
            }else if(($count > 32 and $round == 2)or($count>16 and $count<=32 and $round==1)){
                $teamLoser->last_placement = 16;
            }else if(($count > 32 and $round == 3) or ($count>16 and $count<=32 and $round==2) or ($count<=16 and $round==1)){
                $teamLoser->last_placement = 8;
            }else if(($count > 32 and $round == 4) or ($count>16 and $count<=32 and $round==3) or ($count<=16 and $round==2)){
                $teamLoser->last_placement = 8;
            }else if(($count > 32 and $round == 5) or ($count>16 and $count<=32 and $round==4) or ($count<=16 and $round==3)) {
                if ($match->oddMatch()) {
                    $teamWinner->last_placement = 1;
                    $teamLoser->last_placement = 2;
                } else {
                    $teamWinner->last_placement = 3;
                    $teamLoser->last_placement = 4;
                }
            }else{
                //will not happen
            }
            $teamLoser->save();
            $teamWinner->save();
        }
        session()->flash('message','Your result was given!');
        return redirect('/matches/'.$match->id);
    }
}
