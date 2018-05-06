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
    public function __construct()
    {
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
        }
        session()->flash('message','Your TEAM was created!');
        return redirect('/');
    }

    /**
     * Destroy method
     *
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector11
     */
    public function destroy(Team $team){
        if(!$team) return redirect('/');
        try {
            $team->delete();
        } catch (\Exception $e) {
            session()->flash('fail','No team found!');
        }
        session()->flash('message','Your team was removed!');
        return redirect('/');
    }

    /**
     * Method for adding Players to Team - validation of Player
     *
     * @param Team $team
     * @var $email - email from request
     * @var $player - find player via email
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addPlayer(Team $team){
        $email = request()->email;
        $player = Player::select('id')->where('email', $email)->first();
        if(!$player){
            session()->flash('fail', 'No player found!');
        }
        else{
            if($team->player_id_first==$player->id || $team->player_id_second==$player->id)
                session()->flash('fail', 'Player is already part of this team!');
            else {
                $team->player_id_second=$player->id;
                $team->save();
                session()->flash('message', 'Player was added to your team!');
            }
        }
        return redirect('/teams/'.$team->id);
    }

    /**
     * Method for changing the current Team name - validates Team name
     *
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector1
     */
    public function changeTeamName(Team $team){
        $this->validate(request(),[
            'team_name' => 'required|unique:teams|min:3|max:20|string'
        ]);
        $team->team_name = request('team_name');
        $team->save();
        session()->flash('message','Your team name was changed!');
        return redirect('/teams/'.$team->id);
    }
}
