<?php

namespace App\Models;


/**
 * Class Match
 *
 * @package App\Models
 */
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
        return $this->teamFirstName().' vs '.$this->teamSecondName();
    }
    public function teamFirstName(){
        return $this->teamFirst->team_name;
}
    public function teamSecondName(){
        return $this->teamSecond->team_name;
    }
    public function buildResult(){
        if($this->played)
            return $this->score_first.':'.$this->score_second;
    }
    public function buildReverseResult(){
        if($this->played)
            return $this->score_second.':'.$this->score_first;
    }
}
