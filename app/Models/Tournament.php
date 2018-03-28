<?php

namespace App\Models;


class Tournament extends Model
{
    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function eliminations(){
        return $this->hasMany(Elimination::class);
    }
    public static function archives(){

        return static::selectRaw('tournament_name, id, count(*) as t_name')
            ->groupBy('tournaments.tournament_name', 'id')
            ->orderBy('tournaments.tournament_name')
            ->get();
    }
}
