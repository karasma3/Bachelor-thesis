<?php

namespace App\Models;


/**
 * Class Score
 *
 * @package App\Models
 */
class Score extends Model
{

    public function match()
    {
        return $this->hasOne(Match::class);
    }
}
