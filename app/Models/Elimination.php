<?php

namespace App\Models;



class Elimination extends Model
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
