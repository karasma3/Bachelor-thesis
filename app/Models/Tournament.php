<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function eliminations(){
        return $this->hasMany(Elimination::class);
    }
}
