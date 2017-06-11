<template>
    <div :class="classObject" @click="captureClick">
        {{day.format('D')}}

        <ul class="event-list">
            <li v-for="group in muscle_groups">{{group}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['day'],
        computed: {
            muscle_groups() {
                let muscle_groups =  this.$store.state.diary.filter( e => {
                    return e.date.isSame(this.day, 'day')});
                muscle_groups = _
                    .chain(muscle_groups)
                    .map('muscle_group')
                    .uniq()
                    .value();
                return muscle_groups;

            },
            classObject: function () {
                let today = this.day.isSame(this.$moment(), 'day');
                let eventFormDate = this.$store.state.eventFormDate;
                let eventFormActive = this.$store.state.eventFormActive;
                return {
                    day: true,
                    today,
                    past: this.day.isSameOrBefore(this.$moment(), 'day') && !today,
                    active: eventFormDate.isSame(this.day, 'day') && eventFormActive
                }
            }
        },
        methods: {
            captureClick(e) {
                this.$store.commit('eventFormPos', {x: 632, y: 600});
                this.$store.commit('eventFormActive', true);
                this.$store.commit('eventFormDate', this.day);
/*                this.$store.state.beforeChange = JSON.parse(JSON.stringify(this.$store.state.diary));*/
            }
        }
    }
</script>

<style>
    .event-list li{
        padding: 1px;
        border: 1px solid #85a1ea;
        font-size: 12px;
        cursor: pointer;
        background: hsl(347, 100%, 53%);
        color: #FFFFBC;
    }
</style>