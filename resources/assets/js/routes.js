import Vue from 'vue'
import VueRouter from 'vue-router'

import EadCourses from './components/admin/pages/courses/EadCourses.vue'

Vue.use(VueRouter)

export default new VueRouter({
        //mode: 'history',
	routes: [
        {path: '/cursos', component: EadCourses, name:'courses'},
	],
})