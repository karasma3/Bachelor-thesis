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
    public function participant($team1, $team2){
        foreach ($this->teams as $team){
            if($team->id == $team1 or $team->id == $team2){
               return true;
            }
        }
        return false;
    }
}
