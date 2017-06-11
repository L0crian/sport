<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Article::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->word,
        'content' => $faker->paragraph(120),
        'category_id' => $faker->numberBetween($min = 1, $max = 4) ,
    ];
});
///////////////////////// Exercise ///////////////////////////////////////////////

$factory->define(App\Exercise::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'technique_describe' => $faker->paragraph,
        'advice' => $faker->paragraph,
        'youtube_link' => str_random(10),
        'general_photo' => 'http://forum.dev/exercises/thumbnail.png',
        'main_muscle_group' => $faker->numberBetween($min = 1, $max = 7) ,
        'id_type_equipment' => $faker->numberBetween($min = 1, $max = 4) ,
        'id_type_exercise' => $faker->numberBetween($min = 1, $max = 4) ,
    ];
});



$factory->define(App\ExerciseData::class, function (Faker\Generator $faker) {

    return [
        'set' => $faker->numberBetween($min = 1, $max = 4) ,
        'times' => $faker->numberBetween($min = 1, $max = 30) ,
        'weight' => $faker->numberBetween($min = 1, $max = 30)
    ];
});

$factory->define(App\ExerciseMuscle::class, function (Faker\Generator $faker) {

    return [
        'id_muscle' => $faker->numberBetween($min = 1, $max = 5) ,
        'id_exercise' => $faker->numberBetween($min = 1, $max = 30) ,
    ];
});

$factory->define(App\ExerciseMuscleGroup::class, function (Faker\Generator $faker) {

    return [
        'id_muscle_group' => $faker->numberBetween($min = 1, $max = 5) ,
        'id_exercise' => $faker->numberBetween($min = 1, $max = 30) ,
    ];
});


///////////////////////// Exercise Additional///////////////////////////////////////////////

$factory->define(App\TypeExercise::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\TypeEquipment::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Muscle::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'id_muscle_group' => $faker->numberBetween($min = 1, $max = 4)
    ];
});

$factory->define(App\MuscleGroup::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});

///////////////////////// Diary ///////////////////////////////////////////////

$factory->define(App\TrainingDiary::class, function (Faker\Generator $faker) {

    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 2) ,
        'id_exercise' => $faker->numberBetween($min = 1, $max = 30) ,
        'created_at' => $faker->dateTimeBetween($startDate = '-20 days', $endDate = 'now')
    ];
});

$factory->define(App\TrainingDiaryExerciseData::class, function (Faker\Generator $faker) {

    return [
        'id_training_diary' => $faker->numberBetween($min = 1, $max = 40) ,
        'id_exercise_data' => $faker->numberBetween($min = 1, $max = 100) ,
       ];
});

///////////////////////// Template ///////////////////////////////////////////////

$factory->define(App\Template::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'id_user' => $faker->numberBetween($min = 1, $max = 2),
        'id_type_template' => $faker->numberBetween($min = 1, $max = 4),
        'weeks' => $faker->numberBetween($min = 1, $max = 4),
    ];
});

$factory->define(App\TypeTemplate::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\TemplateDay::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'id_user' => $faker->numberBetween($min = 1, $max = 2) ,
        'id_type_template' => $faker->numberBetween($min = 1, $max = 4) ,
        'weeks' => $faker->numberBetween($min = 1, $max = 4)
    ];
});




