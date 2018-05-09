<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Player
 *
 * @package App\Models
 */
class Player extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'is_admin'
    ];
    protected $table = 'players';

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function teams(){
        return $this->hasMany(Team::class, 'player_id_first')->orWhere('player_id_second', $this->id);
    }
    public function isAdmin()
    {
        return $this->is_admin;
    }
    public function participant($match){
        foreach ($this->teams as $team){
            if($team->id == $match->team_id_first or $team->id == $match->team_id_second){
               return true;
            }
        }
        return false;
    }
}
