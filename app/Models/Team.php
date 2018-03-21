<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function matches(){
        return $this->hasMany(Match::class);
    }
    public function players(){
        return $this->belongsToMany(Player::class);
    }
}
