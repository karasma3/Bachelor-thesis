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
    public function playerFirst(){
        return $this->belongsTo(Player::class, 'player_id_first');
    }
    public function playerSecond(){
        return $this->belongsTo(Player::class, 'player_id_second');
    }
    public function playerFirstFullName(){
        return $this->playerFirst->name.' '.$this->playerFirst->surname;
    }
    public function playerSecondFullName(){
        return $this->playerSecond->name.' '.$this->playerSecond->surname;
    }
    public function groups(){
        return $this->belongsToMany(Group::class, 'group_team')->withPivot(['score_won', 'score_lost', 'points', 'ordering'])->withTimestamps();
    }
    public function tournaments(){
        return $this->belongsToMany( Tournament::class);
    }
    public function buildScore($group_id){
        $score = DB::table('group_team')->select('score_won','score_lost')->where([['group_id', $group_id],['team_id',$this->id]])->first();
        return $score->score_won.':'.$score->score_lost;
    }
    public function showPoints($group_id){
        return DB::table('group_team')->select('points')->where([['group_id', $group_id],['team_id',$this->id]])->first()->points;
    }
    public function showOrder($group_id){
        return DB::table('group_team')->select('ordering')->where([['group_id', $group_id],['team_id',$this->id]])->first()->ordering;
    }
    public function activate($value){
        $this->active = $value;
        $this->save();
    }
    public function getEmails(){
        $email = $this->playerFirst->email . ';';
        if ($this->playerSecond){
            $email = $email . $this->playerSecond->email . ';';
        }
        return $email;
    }
}
