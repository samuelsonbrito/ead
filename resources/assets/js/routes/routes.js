import Vue from 'vue'
import VueRouter from 'vue-router'

import store from '../store/store'

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
import EadLogin from '../components/site/pages/login/EadLogin'

Vue.use(VueRouter)


	const routes = [
                {
                        path: '/',
                        component: EadSite,
                        children: [
                                { path: 'login', component: EadLogin, name: 'login', meta: {auth: false}},
                                { path: 'cursos/:id', component: EadCourseDetail, name: 'course.detail', props: true},
                                { path: '', component: EadHome, name: 'home'},
                                { path: 'contato', component: EadContact, name: 'contact'},
                        ]
                },
                {
                        path: '/admin', 
                        component: EadAdmin,
                        meta: { auth: true },
                        children: [
                                { path: 'categorias/create', component: EadAddCategories, name: 'admin.categories.create'}, 
                                { path: 'categorias/:id/edit', component: EadAddCategories, name: 'admin.categories.edit', props: true},
                                { path: 'categorias', component: EadCategories, name:'admin.categories', meta: {auth: true}},
                                { path: 'cursos', component: EadCourses, name:'admin.courses'},
                                { path: 'cursos/create', component: EadAddCourses, name: 'admin.courses.create'}, 
                                { path: 'cursos/:id/edit', component: EadAddCourses, name: 'admin.courses.edit', props: true},
                                { path: '', component: EadDashboard, name:'admin.dashboard'},
                        ]
                },
                
        ]

const router = new VueRouter({
        routes
})

router.beforeEach((to, from, next) => {
        if(to.meta.auth && !store.state.auth.authenticated){
                store.commit('UPDATE_URL_BACK', to.name)
                return router.push({ name: 'login' })
        }

        if(to.matched.some(record => record.meta.auth) && !store.state.auth.authenticated){
                store.commit('UPDATE_URL_BACK', to.name)
                return router.push({ name: 'login' })
        }

        if(to.meta.hasOwnProperty('auth') && !to.meta.auth && store.state.auth.authenticated){
                return router.push({ name: 'admin.dashboard' })
        }

        next()

})

export default router