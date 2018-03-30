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
        return $this->hasMany(Team::class);
    }
    public function matches(){
        return $this->hasMany(Match::class);
    }
    public function generateMatches(GroupController $groupController){
        return $groupController->generateMatches($this);
    }
}
