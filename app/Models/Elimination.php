<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
