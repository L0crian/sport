<?php

namespace App\Http\Controllers;

use App;
use App\Exercise;
use App\MuscleGroup;
use App\TrainingDiary;
use Illuminate\Http\Request;
use Auth;
use Session;
use Carbon\Carbon;

class DiaryController extends Controller
{

    public function index()
    {
        $diary = $this->diary();
        $exercises = $this->exercises();
        $muscle_groups = $this->muscle_groups();
        return view('diaries.show', compact('diary', 'exercises', 'muscle_groups'));
    }

    public function save(Request $request)
    {
        $obj = json_decode($request->json);
        if (isset($obj->changeDiary)) {
            foreach ($obj->changeDiary as $changeDiary) {
                $data = App\TrainingDiaryExerciseData::where(['id_training_diary' => $changeDiary->diary_id])->get();
                foreach ($data as $element) {
                    $element->delete();
                }
                foreach ($changeDiary->exercise_info as $info) {
                    $newData = App\ExerciseData::create([
                        'set' => $info->set,
                        'times' => $info->times,
                        'weight' => $info->weight
                    ]);
                    App\TrainingDiaryExerciseData::create([
                        'id_training_diary' => $changeDiary->diary_id,
                        'id_exercise_data' => $newData->id
                    ]);
                }
            }
        }
        if (isset($obj->newDiary)) {
            foreach ($obj->newDiary as $diary) {
                $newDiary = App\TrainingDiary::create([
                    'id_exercise' => $diary->id_exercise,
                    'user_id' => Auth::id(),
                    'created_at' => $diary->date
                ]);
                foreach ($diary->diary_info as $info) {
                    $newData = App\ExerciseData::create([
                        'set' => $info->set,
                        'times' => $info->times,
                        'weight' => $info->weight
                    ]);
                    App\TrainingDiaryExerciseData::create([
                        'id_training_diary' => $newDiary->id,
                        'id_exercise_data' => $newData->id
                    ]);
                }
            }
        }
        if (isset($obj->delDiary)) {
            $delDiary = App\TrainingDiary::find($obj->delDiary);
            foreach ($delDiary as $diary) {
                foreach ($diary->diary_info as $info) {
                    $info->delete();
                }
                $diary->delete();
            }
        }

    }


    public function exercises()
    {
        return json_encode(Exercise::with('main_group')->get()->toArray());
    }

    public function muscle_groups()
    {

        return json_encode(MuscleGroup::all()->toArray());
    }

    public function diary()
    {
        $month = 5;
        $date = $this->date_between($month);
        $user_id = Auth::id();
        $trainingDiary = TrainingDiary::where(['user_id' => $user_id])
            ->whereBetween('created_at', array($date['from'], $date['to']))
            ->with('exercise')->with('diary_info')->get();

        foreach ($trainingDiary as $t) {
            $t->exercise->main_group;
        }
        $trainingDiary = json_encode($trainingDiary->toArray());
        return $trainingDiary;
    }


    public function date_between($month)
    {
        $MONDAY = Carbon::MONDAY;
        $SUNDAY = Carbon::SUNDAY;
        $current_day = Carbon::createFromDate(null, $month, 1);
        $date_between = array();

        while ($current_day->dayOfWeek !== $MONDAY) {
            $current_day->subDay();
        }
        $date_between['from'] = $current_day;

        $current_day = Carbon::createFromDate(null, $month + 1, 1)->subDay();
        while ($current_day->dayOfWeek !== $SUNDAY) {
            $current_day->addDay();
        }
        $date_between['to'] = $current_day;

        return $date_between;
    }
}

