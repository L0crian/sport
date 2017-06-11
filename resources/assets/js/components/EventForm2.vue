<template>
    <div id="event-form" :class="{active: active}" :style="{left: left, top: top}">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                          data-toggle="tab">Грудь</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
                                           data-toggle="tab">Profile</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a>
                </li>
                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <exercise v-for="ex in chest" :exercise="ex"></exercise>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">...</div>
                <div role="tabpanel" class="tab-pane" id="messages">...</div>
                <div role="tabpanel" class="tab-pane" id="settings">...</div>
            </div>

        </div>
        <!-- <div class="buttons">
             <button @click="create" :disabled="!description.length">Сохранить</button>
         </div>-->
        <div>
            <div class="col-sm-6">
                <p class="text-left">
                    <button class="btn btn-primary" @click="addExerciseActive">Добавить упражнения</button>
                </p>
            </div>
            <div class="col-sm-6">
                <p class="text-right">
                    <button class="btn btn-success">Сохранить</button>
                </p>
            </div>
        </div>
        <button id="close-button" @click="close">&#10005</button>
        <add-exercise :main_muscle_group="6" id="add-exercise"></add-exercise>
    </div>
</template>

<script>
    import Exercise from './Exercise.vue'
    import AddExercise from './AddExercise.vue'

    export default {
        data() {
            return {
                description: ''
            }
        },
        components: {
            Exercise,
            AddExercise
        },
        computed: {
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
            chest() {
                return this.$store.state.diary.filter(e => e.date.isSame(this.$store.state.eventFormDate, 'day')
                && (e.muscle_group_id === 6));
            },
            arms() {
            },
            legs() {
            },
            back() {
            },
        },
        methods: {
            close() {
                this.$store.commit('eventFormActive', false);
            },
            create() {
                this.$store.dispatch('addEvent', {description: this.description}).then(_ => {
                    this.description = '';
                    this.$store.commit('eventFormActive', false);
                });
            },
            addExerciseActive() {
                this.$store.commit('addExerciseActive', true);
            }
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

    .tab-pane {
        width: 100%;
        height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .tab-content {
        padding: 30px;
    }

</style>