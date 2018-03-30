<?php

namespace App\Models;



class Match extends Model
{
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function elimination(){
        return $this->belongsTo(Elimination::class);
    }
    public function teamFirst(){
        return $this->belongsTo(Team::class, 'team_id_first');
    }
    public function teamSecond(){
        return $this->belongsTo(Team::class, 'team_id_second');
    }
    public function buildName(){
        return $this->teamFirst->team_name.' vs '.$this->teamSecond->team_name;
    }
    public function buildResult(){
        return $this->score_first.':'.$this->score_second;
    }
}
