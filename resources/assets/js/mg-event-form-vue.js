

var Vue = require('vue');

import VueResource from 'vue-resource';
Vue.use(VueResource);


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
    el: '#mg-event-form-vue',
    components: {
      mgEventForm: require('./components/mgEventForm.vue')

    },
    ready() {
      console.log('vue ready');
    }
});
