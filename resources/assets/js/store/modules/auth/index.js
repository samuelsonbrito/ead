import {nameToken} from '../../../config/config'

export default{

    state: {

        user: {},
        authenticated: false,

    },
    mutations: {

        AUTH_USER_ACCEPT(state, user){
            state.authenticated = true,
            state.user = user
        },

    },
    actions: {

        login(context, params){

            context.commit('PRELOADER', true)
            
            return axios.post('/api/auth', params)
                    .then(response => {
                        context.commit('AUTH_USER_ACCEPT',response.data.user)
                        localStorage.setItem(nameToken, response.data.token)
                    })
                    .catch(error => console.log(error))
                    .finally(() => context.commit('PRELOADER', false))
        },

        checkLogin(context){
            
            return new Promise((resolve, reject) => {
                const token = localStorage.getItem(nameToken)
                if(!token)
                    return reject()

                axios.get('/api/me')
                    .then(response => {
                        context.commit('AUTH_USER_ACCEPT',response.data.user)
                        resolve()
                    })
                    .catch(() => reject())
            })

        }

    },
    getters: {

    }

}