<?php

namespace App\Models;


/**
 * Class Match
 *
 * @package App\Models
 */
class Match extends Model
{
    public function score(){
        return $this->belongsTo(Score::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
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
    public function wonFirst(){
        if($this->scoreFirst()==0 and $this->scoreSecond()==0){
            return false;
        }
        if($this->scoreFirst()>$this->scoreSecond()) {
            return true;
        }
        return false;
    }
    public function wonSecond(){
        if($this->scoreFirst()==0 and $this->scoreSecond()==0){
            return false;
        }
        if($this->scoreFirst()<$this->scoreSecond()) {
            return true;
        }
        return false;
    }
    public function getWinnerId(){
        if($this->wonFirst()){
            return $this->team_id_first;
        }
        if($this->wonSecond()){
            return $this->team_id_second;
        }
    }
    public function getLoserId(){
        if($this->wonFirst()){
            return $this->team_id_second;
        }
        if($this->wonSecond()){
            return $this->team_id_first;
        }
    }
    public function scoreFirst(){
        return $this->score->score_first;
    }

    public function scoreSecond(){
        return $this->score->score_second;
    }
    public function buildResult(){
        if($this->played)
            return $this->scoreFirst().':'.$this->scoreSecond();
    }
    public function buildReverseResult(){
        if($this->played)
            return $this->scoreSecond().':'.$this->scoreFirst();
    }
    public function oddMatch(){
        if($this->match_number % 2 != 0){
            return true;
        }
        return false;
    }
}
