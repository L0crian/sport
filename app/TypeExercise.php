<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeExercise extends Model
{
    public $timestamps = false;

    public function exercise()
    {
        $this->hasMany('App\Exercise');
    }
}
