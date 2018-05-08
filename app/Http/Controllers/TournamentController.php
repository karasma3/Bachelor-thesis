<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class TournamentController
 *
 * @package App\Http\Controllers
 */
class TournamentController extends Controller
{
    const GROUP_NAME = 'A';
    const GROUP_SIZE = 4;
    const GROUP_STAGE = 'group_stage';

    public function index(){
        $tournaments = Tournament::all();

        return view('tournaments.index', compact('tournaments'));
    }
    public function show(Tournament $tournament){

        return view('tournaments.show', compact('tournament'));
    }
    public function create(){

        return view('tournaments.create');
    }
    public function edit(Tournament $tournament){
        return view('tournaments.edit', compact('tournament'));
    }
    public function join(Tournament $tournament){
        return view('tournaments.join', compact('tournament'));
    }

    /**
     * Method for adding Team into the Tournament - validates the signing in Team
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addTeam(Tournament $tournament){
        if(auth()->check()) {
            $this->validate(request(),[
               'team_id' => 'required'
            ]);
            if(count($tournament->teams) >= 64){
                session()->flash('fail', 'Tournament is full!');
                return redirect('/tournaments/'.$tournament->id);
            }
            if(!$tournament->teams()->find(request()->get('team_id'))) {
                $tournament->teams()->attach(request('team_id'),['last_placement' => Team::where('id', request('team_id'))->first()->last_placement]);
                session()->flash('message', 'You were signed in into the TOURNAMENT!');
            }
            else{
                session()->flash('fail', 'This TEAM is already signed in!');
            }
        }
        return redirect('/tournaments/'.$tournament->id);
    }
    /**
     * Creating X Groups depending on number of Teams signed in to Tournament
     *
     * @param Tournament $tournament
     * @var $group_ids - all ids of groups previously generated to be deleted
     * @var $team_ids - stores all the Team id associated with $tournament, in random order
     * @var $groups - multidimensional array, stores X Groups by 4 Teams
     * @var $group - 1 Group with 4 Teams
     * @var $team - Team
     * @var $new_group - newly created Group
     * @var group_name - generating names for group, starting from 'A'
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function generateGroups(Tournament $tournament){
        $tournament->generateGroups();
        return redirect('/tournaments/'.$tournament->id);
    }
    public function createBracket(Tournament $tournament){
        $this->calculateScore($tournament);
        $tournament->createBracket();
        return redirect('/tournaments/'.$tournament->id);
    }
    public function nextRound(Tournament $tournament){
        $tournament->nextRound();
        return redirect('/tournaments/'.$tournament->id);
    }
    public function calculateScore(Tournament $tournament){
        foreach ($tournament->groups as $group){
            $group->calculateScore();
            $group->calculateOrder();
        }
        return redirect('/tournaments/'.$tournament->id);
    }
    /**
     * Method for changing the current Tournament name - validates Tournament name
     *
     * @param Tournament $tournament
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeTournamentName(Tournament $tournament){
        $this->validate(request(),[
            'tournament_name' => 'required|unique:tournaments|min:3|max:20|string'
        ]);
        $tournament->tournament_name = request('tournament_name');
        $tournament->save();
        session()->flash('message','Your tournament name was changed!');
        return redirect('/tournaments/'.$tournament->id);
    }

    /**
     * Store method - validates Tournament name
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
