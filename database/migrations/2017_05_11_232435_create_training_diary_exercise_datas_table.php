<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingDiaryExerciseDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_diary_exercise_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_training_diary');
            $table->unsignedInteger('id_exercise_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_diary_exercise_datas');
    }
}
