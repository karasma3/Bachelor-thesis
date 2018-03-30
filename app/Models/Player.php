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
    protected $guarded = [];

    public function teams(){
        return $this->belongsToMany(Team::class);
    }
}
