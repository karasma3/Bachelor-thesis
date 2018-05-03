<?php

namespace App\Models;

/**
 * Class Tournament
 *
 * @package App\Models
 */
class Tournament extends Model
{
    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function teams(){
        return $this->belongsToMany( Team::class);
    }
    public function isCreated(){
        if("created" == $this->phase) return true;
        return false;
    }
    public function isGroupStage(){
        if("group_stage" == $this->phase) return true;
        return false;
    }
    /**
     * Method for getting Tournaments from the Database
     *
     * @return mixed
     */
    public static function archives(){
        return static::selectRaw('tournament_name, id, count(*) as t_name')
            ->groupBy('tournaments.tournament_name', 'id')
            ->orderBy('tournaments.tournament_name')
            ->get();
    }
}
