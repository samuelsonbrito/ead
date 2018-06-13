import {nameToken} from '../../../config/config'

export default{

    state: {

        user: {},
        authenticated: false,
        urlBack: 'home',

    },
    mutations: {

        AUTH_USER_ACCEPT(state, user){
            state.authenticated = true,
            state.user = user
        },

        AUTH_USER_LOGOFF(state){
            state.authenticated = false
            state.user = {},
            state.urlBack = 'home'
        },

        UPDATE_URL_BACK(state, url){
            state.urlBack = url
        },

    },
    actions: {

        login(context, params){

            context.commit('PRELOADER', true)
            
            return axios.post('/api/auth', params)
                    .then(response => {
                        context.commit('AUTH_USER_ACCEPT',response.data.user)

                        const token = response.data.token

                        localStorage.setItem(nameToken, token)

                        window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                    })
                    .catch(error => console.log(error))
                    .finally(() => context.commit('PRELOADER', false))
        },

        checkLogin(context){

            context.commit('PRELOADER', true)
            
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
                    .finally(() => context.commit('PRELOADER', false))
            })

        },

        logoff(context){
            localStorage.removeItem(nameToken)

            context.commit('AUTH_USER_LOGOFF')
        },

    },
    getters: {

    }

}