<?php

namespace App\Models;

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
    public function players(){
        return $this->belongsToMany(Player::class);
    }
    public function groups(){
        return $this->belongsToMany(Group::class);
    }
    public function tournaments(){
        return $this->belongsToMany( Tournament::class);
    }
}
