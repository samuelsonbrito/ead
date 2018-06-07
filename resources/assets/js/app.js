require('./bootstrap');

import Vue from 'vue'
import router from './routes/routes'
import store from './store/store'
import Snotify from 'vue-snotify'

Vue.use(Snotify, {
    toast: {
        showProgressBar: false
    }
})

Vue.component('ead-preloader', require('./components/shared/EadPreloader'))

const app = new Vue({
    store,
    router,
    el: '#app'
});
