<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingDiaryExerciseData extends Model
{
    protected $fillable = ['id_training_diary', 'id_exercise_data'];
    //
    public $timestamps = false;


}
