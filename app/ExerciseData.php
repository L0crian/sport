<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseData extends Model
{
    protected $fillable = ['times', 'set', 'weight'];
    //
    public $timestamps = false;
    protected $table = 'exercise_data';

    public function diary_info()
    {
        return $this->belongsToMany('App\TrainingDiary', 'training_diary_exercise_datas',
            'id_exercise_data', 'id_training_diary');
    }
}
