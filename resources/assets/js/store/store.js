import Vue from 'vue'
import Vuex from 'vuex'
import courses from './modules/courses/index'

Vue.use(Vuex)

export default new Vuex.Store({
	modules:{
        courses
    }
})