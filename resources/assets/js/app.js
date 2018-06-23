require('./bootstrap');

import Vue from 'vue'
import router from './routes/routes'
import store from './store/store'
import Snotify from 'vue-snotify'
import Vuetify from 'vuetify'

Vue.use(Vuetify)
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