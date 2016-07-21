var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);

var moment = require('moment');
// import Validator from 'easiest-js-validator';
// Vue.http.headers.common['X_CSRF-TOKEN'] = document.querySelector('input[name="_token"]').value;
// var vueForm = require('vue-form');
// Vue.use(vueForm);
//
// var autocomplete = require('./components/vue-autocomplete.vue')
//
//
// Vue.component('autocomplete', autocomplete)

new Vue({
    el: '#vue-announcement-app',
    components: {
      AnnouncementApp: require('./components/AnnouncementApp.vue')
    },
    ready() {
      console.log('new Vue AnnouncementApp ready');
    }
});
