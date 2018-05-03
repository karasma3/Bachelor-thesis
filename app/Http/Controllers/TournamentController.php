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
               'team_name' => 'required'
            ]);
            if(!$tournament->teams()->find(request()->get('team_name'))) {
                $tournament->teams()->attach(request('team_name'));
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
    public function generateGroups(Tournament $tournament, GroupController $groupController){
        //delete if previously generated
        $group_ids = DB::table('groups')->select('id')->where('tournament_id', '=', $tournament->id)->get()->toArray();
        foreach ($group_ids as $group_id) {
            DB::table('matches')->where('group_id', '=', $group_id->id)->delete();
        }
//        DB::table('groups')->select('id')->where('tournament_id', '=', $tournament->id)->delete();
        $tournament->groups()->delete();
        //create groups
        $team_ids = DB::table('team_tournament')->select('team_id')->where('tournament_id', $tournament->id)->inRandomOrder()->get()->toArray();
        $groups = array_chunk($team_ids, self::GROUP_SIZE, false);
        $group_name = self::GROUP_NAME;
        foreach ($groups as $group){
            $new_group = Group::create([
                'tournament_id' => $tournament->id,
                'group_name' => $group_name
            ]);
            $group_name++;
            foreach ($group as $team){
                $new_group->teams()->save(Team::find($team->team_id));
            }
            //create matches
            $new_group->generateMatches($groupController);
        }
        $tournament->phase = self::GROUP_STAGE;
        $tournament->save();
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
