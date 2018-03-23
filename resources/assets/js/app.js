require('./bootstrap');

import router from './routes'

window.Vue = require('vue');

const app = new Vue({
    router,
    el: '#app'
});
