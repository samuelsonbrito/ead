import Vue from 'vue'
import Vuex from 'vuex'
import courses from './modules/courses/index'
import preloader from './modules/preloader/preloader'
import categories from './modules/categories/index'
import auth from './modules/auth/index'
import modules from './modules/modules/index'

Vue.use(Vuex)

export default new Vuex.Store({
	modules:{
        courses,
        preloader,
        categories,
        auth,
        modules
    }
})