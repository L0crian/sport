
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment-timezone'

moment.tz.setDefault('UTC');
Object.defineProperty(Vue.prototype, '$moment', {get() {
    return this.$root.moment;
}});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('App', require('./components/App.vue'));
import store from './store'

let diary = window.__INITIAL_STATE__.map(diary_exercise => {

    let exercise_info =  diary_exercise.diary_info.map(info => {
        return {
            //id: info.id,
            set: info.set,
            weight: info.weight,
            times: info.times
        };
    });

    return {
        diary_id: diary_exercise.id,
        exercise_id: diary_exercise.exercise.id,
        date: moment(diary_exercise.created_at),
        title: diary_exercise.exercise.name,
        img: diary_exercise.exercise.general_photo,
        muscle_group: diary_exercise.exercise.main_group.name,
        muscle_group_id: diary_exercise.exercise.main_group.id,
        exercise_info: exercise_info
    };

});


let exercises = window.__EXERCISES__;
let muscle_groups = window.__MUSCLE_GROUPS__;

let initState = Object.assign({}, store.state, {diary}, {exercises}, {muscle_groups});
store.replaceState(initState);


const app = new Vue({
    el: '#app',
    data: {
        moment
    },
    store
});



