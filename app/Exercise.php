<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{

    public $timestamps = false;

    public function type_exercise()
    {
        return $this->belongsTo('App\TypeExercise', 'id_type_exercise', 'id');
    }

    public function type_equipment()
    {
        return $this->belongsTo('App\TypeEquipment', 'id_type_equipment', 'id');
    }

    public function muscle_groups()
    {
        return $this->belongsToMany('App\MuscleGroup', 'exercise_muscle_groups',
            'id_exercise', 'id_muscle_group');
    }

    public function main_group()
    {
        return $this->belongsTo('App\MuscleGroup', 'main_muscle_group', 'id');
    }

    public function muscles()
    {
        return $this->belongsToMany('App\Muscle', 'exercise_muscles',
            'id_exercise', 'id_muscle');
    }

    public function training_diary()
    {
        return $this->hasMany('App\TrainingDiary', 'id_exercise', 'id');
    }
}
