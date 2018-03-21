<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function elimination(){
        return $this->belongsTo(Elimination::class);
    }
    public function team(){
        return $this->belongsTo(Team::class);
    }
}
