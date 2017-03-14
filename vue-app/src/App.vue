<template>
  <div id="app">
    <reports></reports>
  </div>
</template>

<script>
  import Reports from './Reports.vue';
  export default {
    name: 'app',
    data () {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    },
      components: {
        reports: Reports
      }
  }
</script>

