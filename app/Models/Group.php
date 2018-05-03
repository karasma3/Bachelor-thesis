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
        return $this->belongsToMany(Team::class);
    }
    public function matches(){
        return $this->hasMany(Match::class);
    }
    public function generateMatches(GroupController $groupController){
        return $groupController->generateMatches($this);
    }
    public function findMatch($team1, $team2){
        return Match::where([['team_id_first','=',$team1],['team_id_second','=',$team2]])->orWhere([['team_id_first','=',$team2],['team_id_second','=',$team1]])->get();
    }
}
