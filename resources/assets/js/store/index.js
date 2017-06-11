import Vuex from 'vuex';
import Vue from 'vue';

import moment from 'moment-timezone'
moment.tz.setDefault('UTC');

import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        currentYear: 2017,
        currentMonth: 5,
        eventFormPosX: 0,
        eventFormPosY: 0,
        eventFormActive: false,
        addExerciseActive: false,
        eventFormDate: moment(),
        changeDiary: [],
        newDiary: [],
        delDiary: []
    },
    mutations: {
        setCurrentMonth(state, payload) {
            state.currentMonth = payload;
        },
        setCurrentYear(state, payload) {
            state.currentYear = payload;
        },
        eventFormPos(state, payload) {
            state.eventFormPosX = payload.x;
            state.eventFormPosY = payload.y;
        },
        eventFormActive(state, payload) {
            state.eventFormActive = payload;
        },
        addExerciseActive(state, payload) {
            state.addExerciseActive = payload;
        },
        addEvent(state, payload) {
            state.events.push(payload);
        },
        eventFormDate(state, payload) {
            state.eventFormDate = payload;
        },
        addToDiary(state, ids) {
            let ex = _(state.exercises).keyBy('id').at(ids).filter().value();

            ex = ex.map(exercise => {
                    let info = {
                        set: 1,
                        times: 1,
                        weight: 1
                    };
                    state.diary.push({
                        exercise_id: exercise.id,
                        date: state.eventFormDate,
                        title: exercise.name,
                        img: exercise.general_photo,
                        muscle_group_id: exercise.main_muscle_group,
                        muscle_group: exercise.main_group.name,
                        exercise_info: [info]
                    });
                }
            );
        },
        decSet(state, payload){
            state.diary.map(e => {
                if (e.date.isSame(payload.date) && e.exercise_id === payload.exercise_id) {
                    e.exercise_info.pop();
                }
            });
        },
        addSet(state, payload){
            state.diary.map(e => {
                if (e.date.isSame(payload.date) && e.exercise_id === payload.exercise_id) {
                    e.exercise_info.push({
                        set: e.exercise_info.length + 1,
                        times: 1,
                        weight: 1
                    });
                }
            });
        },
        delExercise(state, payload){

            if (payload.diary_id) {
                state.delDiary.push(payload.diary_id);
                let index = state.changeDiary.indexOf(payload.diary_id);
                if (index != -1) {
                    state.changeDiary.splice(index, 1);
                }
            }
            else {
                let index = state.newDiary.indexOf(payload.exercise_id);
                state.newDiary.splice(index, 1);
            }
            state.diary.map((e, index) => {
                if (e.date.isSame(payload.date) && e.exercise_id === payload.exercise_id) {
                    state.diary.splice(index, 1);
                }
            });
        },
        changeDiary(state, payload){
            if (state.changeDiary.indexOf(payload) == -1) {
                state.changeDiary.push(payload);
            }
        },
        newDiary(state, payload){
            for (let i = 0; i < payload.length; i++) {
                state.newDiary.push(parseInt(payload[i]));
            }
        }

    },
    actions: {
  /*      addEvent(context, payload) {
            return new Promise((resolve, reject) => {
                let event = {
                    description: payload.description,
                    date: context.state.eventFormDate
                };
                axios.post('/add_event', event).then(responce => {
                    if (responce.status === 200) {
                        context.commit('addEvent', event);
                        resolve();
                    } else {
                        reject();
                    }
                });
            });
        },*/
        saveChange(context, payload) {
            if (context.state.changeDiary.length
                || context.state.newDiary.length
                || context.state.delDiary.length) {
                let arr = {};

                if (context.state.changeDiary.length) {
                    let changeDiary = context.state.diary.filter(e => e.date.isSame(context.state.eventFormDate, 'day')
                    && (e.muscle_group_id === payload) && _.includes(context.state.changeDiary, e.diary_id));
                    arr['changeDiary'] = changeDiary;
                }

                if (context.state.newDiary.length) {
                    let newDiary = context.state.diary.filter(e => e.date.isSame(context.state.eventFormDate, 'day')
                    && (e.muscle_group_id === payload) && _.includes(context.state.newDiary, e.exercise_id));
                    newDiary = newDiary.map(e => {
                          return {
                            date: e.date.format('YYYY-MM-DD'),
                            id_exercise: e.exercise_id,
                            diary_info: e.exercise_info
                        }
                    });
                    arr['newDiary'] = newDiary;
                }

                if (context.state.delDiary.length) {
                    arr['delDiary'] = context.state.delDiary;
                }

                //console.log(arr);
                /*let json = JSON.stringify(arr);
                var a = document.createElement('a');
                a.className = "mainA";
                a.href = "http://forum.dev/save_change?json=" + json;
                document.body.appendChild(a);*/
                let json = JSON.stringify(arr);
                let str = '/save_change?json='+json;
                axios.get(str).then(response => {
                    console.log(response);
                }).catch(e => {
                    console.log(e);
                });;
                context.state.changeDiary = [];
                context.state.newDiary = [];
                context.state.delDiary = [];
            }

        },
        decSet(context, payload){
            context.commit('decSet', payload);
        },
        addSet(context, payload){
            context.commit('addSet', payload);
        },
        delExercise(context, payload){
            context.commit('delExercise', payload);
        }
    }
})