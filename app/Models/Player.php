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
    protected $table = 'players';

    public function teams(){
        return $this->belongsToMany(Team::class);
    }

    // User::isAdmin()->get();
    public function scopeIsAdmin($query)
    {
        return $query->where('is_admin', true);
    }
}
