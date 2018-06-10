import Vue from 'vue'
import VueRouter from 'vue-router'

import EadCategories from '../components/admin/pages/categories/EadCategories'
import EadCourses from '../components/admin/pages/courses/EadCourses'
import EadDashboard from '../components/admin/pages/dashboard/EadDashboard'
import EadAdmin from '../components/admin/EadAdmin'
import EadAddCategories from '../components/admin/pages/categories/EadAddCategories'
import EadAddCourses from '../components/admin/pages/courses/EadAddCourses'
import EadHome from '../components/site/pages/home/EadHome'
import EadSite from '../components/site/EadSite'
import EadContact from '../components/site/pages/contact/EadContact'
import EadCourseDetail from '../components/site/pages/course/EadCourseDetail'

Vue.use(VueRouter)

export default new VueRouter({
        //mode: 'history',
	routes: [
                {
                        path: '/',
                        component: EadSite,
                        children: [
                                { path: 'cursos/:id', component: EadCourseDetail, name: 'course.detail'},
                                { path: '', component: EadHome, name: 'home'},
                                { path: 'contato', component: EadContact, name: 'contact'},
                        ]
                },
                {
                        path: '/admin', 
                        component: EadAdmin,
                        children: [
                                { path: 'categorias/create', component: EadAddCategories, name: 'admin.categories.create'}, 
                                { path: 'categorias/:id/edit', component: EadAddCategories, name: 'admin.categories.edit', props: true},
                                { path: 'categorias', component: EadCategories, name:'admin.categories'},
                                { path: 'cursos', component: EadCourses, name:'admin.courses'},
                                { path: 'cursos/create', component: EadAddCourses, name: 'admin.courses.create'}, 
                                { path: 'cursos/:id/edit', component: EadAddCourses, name: 'admin.courses.edit', props: true},
                                { path: '', component: EadDashboard, name:'admin.dashboard'},
                        ]
                },
                
        ],
})