require('./bootstrap');

import Vue from 'vue'
import router from './routes'
import Vuetify from 'vuetify'


Vue.use(Vuetify)

const app = new Vue({
    router,
    el: '#app'
});
