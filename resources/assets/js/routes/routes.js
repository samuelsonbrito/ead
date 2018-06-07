import Vue from 'vue'
import VueRouter from 'vue-router'

import EadCategories from '../components/admin/pages/categories/EadCategories'
import EadCourses from '../components/admin/pages/courses/EadCourses'
import EadDashboard from '../components/admin/pages/dashboard/EadDashboard'
import EadAdmin from '../components/admin/EadAdmin'
import EadAddCategories from '../components/admin/pages/categories/EadAddCategories'

Vue.use(VueRouter)

export default new VueRouter({
        //mode: 'history',
	routes: [
                {
                        path: '/admin', 
                        component: EadAdmin,
                        children: [
                                { path: 'categorias/create', component: EadAddCategories, name: 'admin.categories.create'}, 
                                { path: 'categorias/:id/edit', component: EadAddCategories, name: 'admin.categories.edit', props: true},
                                {path: 'categorias', component: EadCategories, name:'admin.categories'},
                                {path: 'cursos', component: EadCourses, name:'admin.courses'},
                                {path: '', component: EadDashboard, name:'admin.dashboard'},
                        ]
                },
                
	],
})