<?php

namespace App\Models;


class Team extends Model
{
    public function matches(){
        return $this->hasMany(Match::class);
    }
    public function players(){
        return $this->belongsToMany(Player::class);
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function elimination(){
        return $this->belongsTo(Elimination::class);
    }
    public function tournaments(){
        return $this->belongsToMany( Tournament::class);
    }
}
