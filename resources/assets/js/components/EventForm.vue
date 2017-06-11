<template>
    <div id="event-form" :class="{active: active}" :style="{left: left, top: top}">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li v-for="(tab, index) in tabs":class="{active: currentTab == tab.id}" @click="changeTab(tab.id)">
                    <a>{{tab.name}}</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div v-show="currentTab == 0" class="tab-exercise">
                    <h3>Выберите группу мышц</h3>
                </div>
                <div v-show="currentTab == 1" class="tab-exercise">
                    <exercise v-for="ex in legs" :exercise="ex"></exercise>
                </div>
                <div  v-show="currentTab == 2" class="tab-exercise">
                    <exercise v-for="ex in arms" :exercise="ex"></exercise>
                </div>
                <div  v-show="currentTab == 3" class="tab-exercise">
                    <exercise v-for="ex in chest" :exercise="ex"></exercise>
                </div>
                <div  v-show="currentTab == 4" class="tab-exercise">
                    <exercise v-for="ex in back" :exercise="ex"></exercise>
                </div>
                <div v-show="currentTab == 5" class="tab-exercise">
                    <exercise v-for="ex in shoulders" :exercise="ex"></exercise>
                </div>
            </div>

        </div>
          <div>
            <div class="col-sm-6">
                <p class="text-left">
                    <button class="btn btn-primary" @click="addExerciseActive">Добавить упражнения</button>
                </p>
            </div>
            <div class="col-sm-6">
                <p class="text-right">
                    <!--<button class="btn btn-primary" @click="saveChange">Сохранить</button>-->
                </p>
            </div>
        </div>
        <button id="close-button" @click="close">&#10005</button>
        <add-exercise :ids="get_ids" :main_muscle_group="currentTab" id="add-exercise"></add-exercise>
    </div>
</template>

<script>
    import Exercise from './Exercise.vue'
    import AddExercise from './AddExercise.vue'

    export default {
        data() {
            return {
                description: '',
                isActive: false,
                currentTab: 1,
                save: false
            }
        },
        components: {
            Exercise,
            AddExercise
        },
        computed: {
            tabs() {
                return this.$store.state.muscle_groups;
            },
            date() {
                return this.$store.state.eventFormDate;
            },
            top() {
                return `${this.$store.state.eventFormPosY}px`;
            },
            left() {
                return `${this.$store.state.eventFormPosX}px`;
            },
            active() {
                return this.$store.state.eventFormActive;
            },
            legs() {
                return this.$store.state.diary.filter(e => e.date.isSame(this.$store.state.eventFormDate, 'day')
                && (e.muscle_group_id === 1));
            },
            arms() {
                return this.$store.state.diary.filter(e => e.date.isSame(this.$store.state.eventFormDate, 'day')
                && (e.muscle_group_id === 2));
            },
            chest() {
                return this.$store.state.diary.filter(e => e.date.isSame(this.$store.state.eventFormDate, 'day')
                && (e.muscle_group_id === 3));
            },
            back() {
                return this.$store.state.diary.filter(e => e.date.isSame(this.$store.state.eventFormDate, 'day')
                && (e.muscle_group_id === 4));
            },
            shoulders() {
                return this.$store.state.diary.filter(e => e.date.isSame(this.$store.state.eventFormDate, 'day')
                && (e.muscle_group_id === 5));
            },
            get_ids() {
               let ex = this.$store.state.diary.filter(e => e.date.isSame(this.$store.state.eventFormDate, 'day'));
               let ids = [];
               ex.map(e => {
                   ids.push(e.exercise_id);});
               return ids;
            }
        },
        methods: {
            close() {
                this.$store.dispatch('saveChange', this.currentTab );
                this.$store.commit('eventFormActive', false);
                this.currentTab = 0;
            },
            create() {
                this.$store.dispatch('addEvent', {description: this.description}).then(_ => {
                    this.description = '';
                    this.$store.commit('eventFormActive', false);
                });
            },
            addExerciseActive() {
                this.$store.commit('addExerciseActive', true);
            },
            changeTab(id) {
                /*console.log(this.$store.state.beforeChange);
                console.log(this.$store.state.diary);
                console.log(deepEqual(
                    this.$store.state.beforeChange,
                    this.$store.state.diary
                ));
                if(!(JSON.stringify(this.$store.state.beforeChange) === JSON.stringify(this.$store.state.diary))) {
                    this.$store.state.diary =  JSON.parse(JSON.stringify(this.$store.state.beforeChange));
                }
                this.$store.state.beforeChange =JSON.parse(JSON.stringify(this.$store.state.diary));*/
                this.$store.dispatch('saveChange', this.currentTab );
                this.currentTab = id;
            },
        },
        directives: {
            focus: {
                update(el) {
                    el.focus();
                }
            }
        }
    }
</script>

<style>
    body #app #event-form {
        width: 80%;
    }

    .tab-exercise {
        width: 100%;
        height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .tab-content {
        padding: 30px;
    }

</style>