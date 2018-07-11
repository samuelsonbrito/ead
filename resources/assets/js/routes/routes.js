import Vue from 'vue'
import VueRouter from 'vue-router'

import store from '../store/store'

import EadSales from '../components/campus/pages/sales/EadSales'
import EadSalesCourses from '../components/campus/pages/sales/EadSalesCourses'
import EadSalesCoursesClassrooms from '../components/campus/pages/sales/EadSalesCoursesClassrooms'
import EadCampus from '../components/campus/EadCampus'
import EadCampusDashboard from '../components/campus/pages/dashboard/EadDashboard'
import EadModules from '../components/admin/pages/modules/EadModules'
import EadAddModules from '../components/admin/pages/modules/EadAddModules'
import EadCategories from '../components/admin/pages/categories/EadCategories'
import EadCourses from '../components/admin/pages/courses/EadCourses'
import EadCoursesModules from '../components/admin/pages/courses/EadCoursesModules'
import EadAddCoursesModules from '../components/admin/pages/courses/EadAddCoursesModules'
import EadCoursesModulesClassrooms from '../components/admin/pages/courses/EadCoursesModulesClassrooms'
import EadAddCoursesModulesClassrooms from '../components/admin/pages/courses/EadAddCoursesModulesClassrooms'
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
                { path: 'login', component: EadLogin, name: 'login', meta: {auth: false} },
                { path: 'cursos/:id', component: EadCourseDetail, name: 'course.detail', props: true },
                { path: '', component: EadHome, name: 'home' },
                { path: 'contato', component: EadContact, name: 'contact' },
        ]
},
{
        path: '/admin', 
        component: EadAdmin,
        meta: { auth: true, level: 1 },
        children: [
                { path: 'modulos/create', component: EadAddModules, name: 'admin.modules.create', props: true, meta: { auth: true, level: 1} }, 
                { path: 'modulos/:id/edit', component: EadAddModules, name: 'admin.modules.edit', props: true, meta: { auth: true, level: 1} },
                { path: 'modulos', component: EadModules, name:'admin.modules', meta: { auth: true, level: 1} },
                { path: 'categorias/create', component: EadAddCategories, name: 'admin.categories.create',props: true, meta: { auth: true, level: 1} }, 
                { path: 'categorias/:id/edit', component: EadAddCategories, name: 'admin.categories.edit', meta: { auth: true, level: 1} },
                { path: 'categorias', component: EadCategories, name:'admin.categories', meta: { auth: true, level: 1} },
                { path: 'cursos', component: EadCourses, name:'admin.courses', meta: { auth: true, level: 1} },
                { path: 'cursos/create', component: EadAddCourses, name: 'admin.courses.create', meta: { auth: true, level: 1} }, 
                { path: 'cursos/:id/edit', component: EadAddCourses, name: 'admin.courses.edit', props: true, meta: { auth: true, level: 1} },
                { path: 'cursos/:cid/modulos', component: EadCoursesModules, name:'admin.courses.modules', meta: { auth: true, level: 1} },
                { path: 'cursos/:cid/modulos/create', component: EadAddCoursesModules, name:'admin.courses.modules.create', meta: { auth: true, level: 1} },
                { path: 'cursos/:cid/modulos/:id/edit', component: EadAddCoursesModules, name:'admin.courses.modules.edit', meta: { auth: true, level: 1} },
                { path: 'cursos/:cid/modulos/:mid/classrooms', component: EadCoursesModulesClassrooms, name:'admin.courses.modules.classrooms', meta: { auth: true, level: 1} },
                { path: 'cursos/:cid/modulos/:mid/classrooms/create', component: EadAddCoursesModulesClassrooms, name:'admin.courses.modules.classrooms.create', meta: { auth: true, level: 1} },
                { path: 'cursos/:cid/modulos/:mid/classrooms/:id/edit', component: EadAddCoursesModulesClassrooms, name:'admin.courses.modules.classrooms.edit', meta: { auth: true, level: 1} },
                { path: '', component: EadDashboard, name:'admin.dashboard', meta: { auth: true, level: 1} },

        ]
},
{
        path: '/campus', 
        component: EadCampus,
        meta: { auth: true },
        children: [
                { path: '', component: EadCampusDashboard, name:'campus.dashboard', meta: { auth: true, level: 2}  },
                { path: 'meus-cursos', component: EadSales, name:'campus.courses', meta: { auth: true, level: 2}  },
                { path: 'meus-cursos/:url', component: EadSalesCourses, name:'campus.courses.sales', meta: { auth: true, level: 2}  },
                { path: 'meus-cursos/:url/watch/:id', component: EadSalesCoursesClassrooms, name:'campus.courses.sales.watch', meta: { auth: true, level: 2}  },
        ]
}

]

const router = new VueRouter({
        routes
})

router.beforeEach((to, from, next) => {


        if(to.meta.auth && store.state.auth.authenticated && to.meta.level != store.state.auth.user.level){
                localStorage.removeItem('token_auth')
                store.commit('AUTH_USER_LOGOFF')
                router.push({ name: 'login' })
        }

        if(to.meta.auth && !store.state.auth.authenticated){
                store.commit('UPDATE_URL_BACK', to.name)
                return router.push({ name: 'login' })
        }

        if(to.matched.some(record => record.meta.auth) && !store.state.auth.authenticated){
                store.commit('UPDATE_URL_BACK', to.name)
                return router.push({ name: 'login' })
        }

        if(to.meta.hasOwnProperty('auth') && !to.meta.auth && store.state.auth.authenticated){

                if(store.state.auth.user.level == 1){
                        return router.push({ name: 'admin.dashboard' })
                }else{
                        return router.push({ name: 'campus.dashboard' })
                }
                
        }

        next()

})

export default router