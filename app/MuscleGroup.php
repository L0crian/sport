<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MuscleGroup extends Model
{
    //
    public $timestamps = false;

    public function exercises()
    {
        return $this->belongsToMany('App\Exercise', 'exercise_muscle_groups',
            'id_muscle_group', 'id_exercise');
    }

    public function muscles()
    {
        $this->hasMany('App\Muscle');
    }
}
