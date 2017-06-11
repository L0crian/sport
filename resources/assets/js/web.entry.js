/*
import Vue from 'vue'
import './style.scss'

import moment from 'moment-timezone'
moment.tz.setDefault('UTC');
Object.defineProperty(Vue.prototype, '$moment', {get() {
  return this.$root.moment;
}});

import App from './components/App.vue';
import store from './store'

/!*
let events = [
    {description: 'Music', date: moment('2017-05-05', 'YYYY-MM-DD')},
    {description: 'Music', date: moment()}
];
*!/

let events = window.__INITIAL_STATE__.map(event => {
    return {
        description: event.description,
        date: moment(event.date)
    };
})

let initState = Object.assign({}, store.state, {events});
store.replaceState(initState);

new Vue({
    el: '#app',
    data: {
        moment
    },
    components: {
        App
    },
    store
});
*/
