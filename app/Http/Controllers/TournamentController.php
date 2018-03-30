<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TournamentController extends Controller
{
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
    public function generateGroups(Tournament $tournament){
        $team_ids = DB::table('team_tournament')->select('team_id')->where('tournament_id', $tournament->id)->inRandomOrder()->get()->toArray();
        $groups = array_chunk($team_ids, 4, false);
        $group_name = 'A';
        foreach ($groups as $group){
            $new_group = Group::create([
                'tournament_id' => $tournament->id,
                'group_name' => $group_name
            ]);
            $group_name++;
            foreach ($group as $team){
                $new_group->teams()->save(Team::find($team->team_id));
            }
        }
        return redirect('/tournaments/'.$tournament->id);
    }
    public function changeTournamentName(Tournament $tournament){
        $this->validate(request(),[
            'tournament_name' => 'required|unique:tournaments|min:3|max:20|string'
        ]);
        $tournament->tournament_name = request('tournament_name');
        $tournament->save();
        session()->flash('message','Your tournament name was changed!');
        return redirect('/tournaments/'.$tournament->id);
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
