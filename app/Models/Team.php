<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class Team
 *
 * @package App\Models
 */
class Team extends Model
{
    public function matches(){
        return $this->hasMany(Match::class, 'team_id_first')->orWhere('team_id_second', $this->id);
    }
    public function players(){
        return $this->belongsToMany(Player::class);
    }
    public function groups(){
        return $this->belongsToMany(Group::class, 'group_team')->withPivot(['score_won', 'score_lost', 'points', 'ordering'])->withTimestamps();
    }
    public function tournaments(){
        return $this->belongsToMany( Tournament::class);
    }
    public function buildScore($group_id){
        $tmp_object = DB::table('group_team')->select('score_won','score_lost')->where([['group_id', $group_id],['team_id',$this->id]]);
        return $tmp_object->first()->score_won.':'.$tmp_object->first()->score_lost;
    }
    public function showPoints($group_id){
        return DB::table('group_team')->select('points')->where([['group_id', $group_id],['team_id',$this->id]])->first()->points;
    }
    public function showOrder($group_id){
        return DB::table('group_team')->select('ordering')->where([['group_id', $group_id],['team_id',$this->id]])->first()->ordering;
    }
}
