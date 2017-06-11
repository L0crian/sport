<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('technique_describe');
            $table->text('advice');
            $table->string('youtube_link');
            $table->string('general_photo');
            $table->integer('main_muscle_group');
            $table->unsignedTinyInteger('id_type_equipment');
            $table->unsignedTinyInteger('id_type_exercise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
}
