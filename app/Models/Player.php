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
        return $this->belongsToMany(Team::class);
    }

    // User::isAdmin()->get();
    public function scopeIsAdmin($query)
    {
        return $query->where('is_admin', true);
    }
}
