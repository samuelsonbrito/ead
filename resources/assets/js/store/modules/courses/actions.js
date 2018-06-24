import {http} from '../../../config/config'

const CONFIG = {
    headers: {
		'content-type': 'multipart/form-data',
	},
}
export default{

    loadCourses(context, params){

        context.commit('PRELOADER', true)
        
        http.get('courses', {params})
            .then(response => {
                console.log(response.data.data)
                context.commit('LOAD_COURSES',response.data)
            }).catch(error => {
                console.log(error)
            }).finally(() =>  context.commit('PRELOADER', false))
    },

    loadCourse(context, id){

        context.commit('PRELOADER', true)

        return new Promise((resolve, reject)=>{

            http.get(`courses/${id}`)
            .then(response => resolve(response.data))
            .catch(error => reject(error))
            .finally(() => context.commit('PRELOADER', false))

        })
    },

    loadMyCourse(context, url){

        context.commit('PRELOADER', true)

        return new Promise((resolve, reject)=>{

            http.get(`my-course/${url}`)
            .then(response => resolve(response.data))
            .catch(error => reject(error))
            .finally(() => context.commit('PRELOADER', false))

        })
    },

    storeCourse(context, params){
        
        context.commit('PRELOADER', true)

        if(params.get('id')){

            params.append('_method', 'PUT')

            return new Promise((resolve, reject)=>{

                http.post(`courses/${params.get('id')}`, params, {CONFIG})
                .then(response => resolve())
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))

            })

        }else{

            return new Promise((resolve, reject)=>{

                http.post('courses', params, {CONFIG})
                .then(response => resolve())
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))

            })

        }
    },

    destroyCourse(context, id){
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject)=>{

            http.delete(`courses/${id}`)
            .then(response => resolve())
            .catch(error => reject(error))
            .finally(() => context.commit('PRELOADER', false))

        })
    },
}