<template>
    <div class="row exercise-info">
        <div class="col-md-2">
            <h3 class="exercise-title">{{exercise.title}}</h3>
            <a href="" class="thumbnail">
                <img :src="exercise.img" alt="">
            </a>
        </div>
        <div class="col-md-offset-2 col-md-8">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Подход</th>
                    <th>Вес</th>
                    <th>Кол-во</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(info, index) in exercise.exercise_info">
                    <td>{{info.set}}</td>
                    <td><input v-on:change="changeData" v-model="exercise.exercise_info[index].weight" :value="info.weight"></td>
                    <td><input v-on:change="changeData" v-model="exercise.exercise_info[index].times" :value="info.times"></td>
                </tr>
                  </tbody>
            </table>
            <div class="btn-toolbar">
                <button class="btn btn-warning pull-left" @click="delExercise">Удалить упражнение</button>
                <button class="btn  btn-danger dec-set pull-right" @click = "decSet">-</button>
                <button class="btn  btn-success add-set pull-right" @click = "addSet">+</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['exercise'],
        methods: {
            decSet() {
                this.changeData();
                this.$store.dispatch('decSet', this.exercise);
            },
            addSet() {
                this.changeData();
                this.$store.dispatch('addSet', this.exercise);
            },
            delExercise() {
                    this.$store.dispatch('delExercise', this.exercise);
            },
            changeData() {
                if(this.exercise.diary_id) {
                    this.$store.commit('changeDiary', this.exercise.diary_id);
                }
         }
        }
    }


</script>

<style>
    .exercise-info {
        padding: 10px;
    }

    .exercise-title {
        margin-top: 0;
        margin-bottom: 10px;
    }
</style>