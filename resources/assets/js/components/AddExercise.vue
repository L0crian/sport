<template>
<div  :class="{addExerciseShow: active}">
    <div class="show-exercises">
       <div v-for="exercise in exercises" :id="exercise.id" @click="addExercise" class="exercise">
           <h5 :id="exercise.id" @click="addExercise">{{exercise.name}}</h5>
           <img :id="exercise.id" @click="addExercise" :src="exercise.general_photo" alt="">
       </div>
    </div>
    <div class="exercise-buttons">
        <div class="col-sm-6">
            <p class="text-left">
                <button @click="add" class="btn btn-primary">Добавить</button>
            </p>
        </div>
        <div class="col-sm-6">
            <p class="text-right">
                <button @click="close" class="btn btn-success">Отмена</button>
            </p>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                exercises_id: []
            }
        },
        props: ['main_muscle_group', 'ids'],
        computed: {
            exercises() {
                return this.$store.state.exercises.filter(e => ((e.main_muscle_group === this.main_muscle_group)
                && !_.includes(this.ids, e.id)));
            },
            active() {
                return this.$store.state.addExerciseActive;
            },
        },
        methods: {
            close() {
                this.$store.commit('addExerciseActive', false);
            },
            add(){
                this.addToDiary(_.uniq(this.exercises_id));
                this.close();
            },
            addExercise(e) {
                e.target.parentElement.style.opacity = 0.5;
                this.exercises_id.push(e.target.id);
            },
            addToDiary(ids){
                this.newDiary(ids);
                this.$store.commit('addToDiary', ids);
                this.exercises_id = [];
            },
            newDiary(ids){
                this.$store.commit('newDiary', ids);
            }
        }
    }
</script>

<style>
    #add-exercise {
        display: none;
    }

    .show-exercises {
        width: 100%;
        height: 86%;
        overflow-y: scroll;
        overflow-x: hidden;
        box-sizing: border-box;
        padding: 30px;
    }

    .show-exercises > div {
        position: relative;
        display: inline-block;
        margin: 0 4px 4px 0;
        box-sizing: border-box;
    }

    .show-exercises > div > h5{
        opacity: 0;
        width: 100%;
        left: 0;
        bottom: 0;
        color: #e0e0e0;
        margin: 0;
        padding: 20px 4px;
        position: absolute;
        transition-property: background;
        transition-duration: 0.3s;
        transition-timing-function: linear;
    }

    .show-exercises > div:hover h5{
        background-color:rgba(0,0,0, 0.5);
        opacity: 1;
    }

    .exercise-buttons {
        padding: 10px;
    }

    #event-form .addExerciseShow {
        display: block;
    }

</style>