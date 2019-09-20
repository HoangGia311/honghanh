import cookie from 'js-cookie'
import { router } from '@/main.js'
let token_name = process.env.VUE_APP_TOKEN_NAME ? process.env.VUE_APP_TOKEN_NAME : 'token'
let token = cookie.get(token_name)  
const state = {
    token_name: token_name ,
    token : token ,
    user : null,
};

const getters = {
    getToken(state){
        return state.token
    },
    getUser(state){
        return state.user
    },
};

const actions = {
    login({ commit } , payload ){
        return new Promise(function(resolve, reject) {
            axios.post('/api/login', payload )
            .then(function (res) {
                let { code , data } = res.data 
                if( code ){
                    commit('login', data)
                }
                resolve(res)
            })
            .catch(function (err) {
                reject(err)
            });
        });
    },
    getUserInfo({commit} ){
        return new Promise(function(resolve, reject) {
            axios.get('/api/user-login')
            .then(function (res) {
                let { code , data } = res.data 
                if( code ){
                    commit('setUser', data.user)
                }
                resolve(res)
            })
            .catch(function (err) {
                reject(err)
            });
        });
    },
    logout({commit}){
        commit('logout')
    },
};

const mutations = {
    login(state, { token }) {
        state.token = token
        cookie.set(`${state.token_name}` , token , { expires: 30 })
    },
    logout(state){
        state.token = null 
        state.user_type  = null 
        cookie.remove(`${state.token_name}`)
        router.push({ name : 'Login' })
    },
    setUser(state , payload ){
        state.user = payload
    },
};
export default {
    state,
    actions,
    mutations,
    getters,
    namespaced: true,
};