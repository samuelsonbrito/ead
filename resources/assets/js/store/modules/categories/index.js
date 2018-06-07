import {http} from '../../../config/config'

export default{

    state: {
        items: {
            data: []
        }
    },
    mutations: {
        LOAD_CATEGORIES(state, categories){
            state.items = categories
        }
    },
    actions: {

        loadCategories(context, params){

            context.commit('PRELOADER', true)

            http.get('categories', {params})
                .then(response => {
                    console.log(response)
                    context.commit('LOAD_CATEGORIES', response.data)
                }).catch(error => {
                    console.log('Erro: '+error)
                }).finally(() => context.commit('PRELOADER', false))
        },

        loadCategory(context, id){

            context.commit('PRELOADER', true)

            return new Promise((resolve, reject)=>{

                http.get(`categories/${id}`)
                .then(response => resolve(response.data))
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))

            })
        },

        storeCategory(context, params){
            
            context.commit('PRELOADER', true)

            if(params.id){

                return new Promise((resolve, reject)=>{

                    http.put(`categories/${params.id}`, params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
    
                })

            }else{

                return new Promise((resolve, reject)=>{

                    http.post('categories', params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
    
                })

            }
  
        },

        destroyCategory(context, id){
            context.commit('PRELOADER', true)

            return new Promise((resolve, reject)=>{

                http.delete(`categories/${id}`)
                .then(response => resolve())
                .catch(error => reject(error))
                //.finally(() => context.commit('PRELOADER', false))

            })
        },

    },
    getters: {

    }

}