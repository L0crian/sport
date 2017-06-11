<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    //
    public $timestamps = false;

    public function muscle_groups()
    {
        return $this->belongsTo('App\MuscleGroup', 'id_muscle_group', 'id');
    }

    public function exercises()
    {
      return   $this->belongsToMany('App\Exercise', 'exercise_muscles',
            'id_muscle', 'id_exercise');
    }
}
