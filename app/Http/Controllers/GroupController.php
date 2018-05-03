<?php

namespace App\Http\Controllers;

use App\Models\Match;
use Illuminate\Http\Request;
use App\Models\Group;

/**
 * Class GroupController
 *
 * @package App\Http\Controllers
 */
class GroupController extends Controller
{
    public function index(){
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }
    public function show(Group $group){

        return view('groups.show', compact('group'));
    }

    /**
     * Method to generate Matches - validates if there is the same record in DB
     *
     * @param Group $group
     */
    public function generateMatches(Group $group){
        foreach ($group->teams as $team_one){
            foreach ($group->teams as $team_two){
                $first_id = min($team_one->id,$team_two->id);
                $second_id = max($team_one->id,$team_two->id);
                if($first_id!=$second_id){
                    if(!Match::where([['team_id_first', '=', $first_id],['team_id_second', '=', $second_id]])->exists())
                        $match = Match::create([
                            'team_id_first' => $first_id,
                            'team_id_second' => $second_id,
                            'group_id' => $group->id
                        ]);
                }
            }
        }
    }
}
