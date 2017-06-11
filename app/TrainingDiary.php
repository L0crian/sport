<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingDiary extends Model
{
    protected $fillable = ['id_exercise', 'user_id', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function exercise()
    {
        return $this->belongsTo('App\Exercise', 'id_exercise', 'id');
    }

    public function diary_info()
    {
        return $this->belongsToMany('App\ExerciseData', 'training_diary_exercise_datas',
            'id_training_diary', 'id_exercise_data');
     }


  }
