<?php

namespace App\Models;
use App\Http\Controllers\GroupController;


/**
 * Class Group
 *
 * @package App\Models
 */
class Group extends Model
{
    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }
    public function teams(){
        return $this->belongsToMany(Team::class, 'group_team')->withPivot(['score', 'points', 'ordering'])->withTimestamps();
    }
    public function matches(){
        return $this->hasMany(Match::class);
    }
    public function generateMatches(){
        foreach ($this->teams as $team_one){
            foreach ($this->teams as $team_two){
                $first_id = min($team_one->id,$team_two->id);
                $second_id = max($team_one->id,$team_two->id);
                if($first_id!=$second_id){
                    if(!Match::where([['team_id_first', '=', $first_id],['team_id_second', '=', $second_id]])->exists())
                        $match = Match::create([
                            'team_id_first' => $first_id,
                            'team_id_second' => $second_id,
                            'group_id' => $this->id
                        ]);
                }
            }
        }
        //return $groupController->generateMatches($this);
    }
    public function findMatch($team1, $team2){
        return Match::where([['team_id_first','=',$team1],['team_id_second','=',$team2]])->orWhere([['team_id_first','=',$team2],['team_id_second','=',$team1]])->get();
    }
}
