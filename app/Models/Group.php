<?php

namespace App\Models;


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
}
