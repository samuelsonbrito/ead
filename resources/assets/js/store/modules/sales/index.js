import {http} from '../../../config/config'

export default{

    state: {
        items: {
            data: []
        }
    },
    mutations: {
        LOAD_SALES(state, sales){
            state.items = sales
        },
        LOAD_MY_SALES(state, sales){
            state.items = sales
        }
    },
    actions: {

        loadSales(context, params){

            context.commit('PRELOADER', true)

            http.get('sales', {params})
                .then(response => {
                    console.log(response)
                    context.commit('LOAD_SALES', response.data)
                }).catch(error => {
                    console.log('Erro: '+error)
                }).finally(() => context.commit('PRELOADER', false))
        },

        loadMySales(context, params){

            context.commit('PRELOADER', true)

            http.get('my-sales', {params})
                .then(response => {
                    console.log(response)
                    context.commit('LOAD_MY_SALES', response.data)
                }).catch(error => {
                    console.log('Erro: '+error)
                }).finally(() => context.commit('PRELOADER', false))
        },

        loadSale(context, id){

            context.commit('PRELOADER', true)

            return new Promise((resolve, reject)=>{

                http.get(`sales/${id}`)
                .then(response => resolve(response.data))
                .catch(error => reject(error))
                .finally(() => context.commit('PRELOADER', false))

            })
        },

        storeSale(context, params){
            
            context.commit('PRELOADER', true)

            if(params.id){

                return new Promise((resolve, reject)=>{

                    http.put(`sales/${params.id}`, params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
    
                })

            }else{

                return new Promise((resolve, reject)=>{

                    http.post('sales', params)
                    .then(response => resolve())
                    .catch(error => reject(error))
                    .finally(() => context.commit('PRELOADER', false))
    
                })

            }
  
        },

        destroySale(context, id){
            context.commit('PRELOADER', true)

            return new Promise((resolve, reject)=>{

                http.delete(`sales/${id}`)
                .then(response => resolve())
                .catch(error => reject(error))
                //.finally(() => context.commit('PRELOADER', false))

            })
        },

    },
    getters: {

    }

}