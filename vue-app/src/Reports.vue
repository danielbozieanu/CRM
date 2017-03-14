<template>
    <div class="row">
        <div class="col-md-4" v-for="question of questions">
            <report :report="question"></report>
        </div>
    </div>
</template>
<script>
    import axios, { Axios } from 'axios';
    import Report from './Report.vue';

    export default {
        mounted () {
            axios.get('http://localhost/crm/reports/get_data', { headers: { 'Content-Type': 'application/json' } })
                .then((res) => this.questions = res.data)
                .catch(err => console.log(err))
        },
        name: 'reports',
        data() {
            return {
                questions: []
            }
        },
        components: {
            'report': Report
        }
    };
</script>

<style>
    .row {
        margin: 0 -15px;
    }
    .col-md-4 {
        width: 30%;
        float: left;
        padding: 0 15px;
    }
</style>