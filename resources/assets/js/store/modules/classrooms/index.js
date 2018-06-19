import {http} from '../../../config/config'

export default{

    state: {
        items: {
            data: []
        }
    },
    mutations: {
        LOAD_CLASSROOMS(state, classrooms){
            state.items = classrooms
        }
    },
    actions: {

        loadClassrooms(context, params){

            context.commit('PRELOADER', true)

            http.get('classrooms', {params})
                .then(response => {
                    context.commit('LOAD_CLASSROOMS', response.data)
                }).catch(error => {
                    console.log('Erro: '+error)
                }).finally(() => context.commit('PRELOADER', false))
        },

        loadClassroom(context, id){

            context.commit('PRELOADER', true)

            return new Promise((resolve, reject)=>{

                http.get(`classrooms/${id}`)
                .then(response => resolve(response.data))
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))

            })
        },

        storeClassroom(context, params){
            
            context.commit('PRELOADER', true)

            if(params.id){

                return new Promise((resolve, reject)=>{

                    http.put(`classrooms/${params.id}`, params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
    
                })

            }else{

                return new Promise((resolve, reject)=>{

                    http.post('classrooms', params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
    
                })

            }
  
        },

        destroyClassroom(context, id){
            context.commit('PRELOADER', true)

            return new Promise((resolve, reject)=>{

                http.delete(`classrooms/${id}`)
                .then(response => resolve())
                .catch(error => reject(error))
                //.finally(() => context.commit('PRELOADER', false))

            })
        },

    },
    getters: {

    }

}