require('./bootstrap');

import Vue from 'vue'
import router from './routes/routes'
import store from './store/store'
import BootstrapVue from 'bootstrap-vue'
import Snotify from 'vue-snotify'

Vue.use(BootstrapVue);
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

store.dispatch('checkLogin')
    .then(()=> router.push({name: store.state.auth.urlBack}))