import cookie from 'js-cookie'
import { router } from '@/main.js'
export default {
    login(state,  payload) {
        let { token  = '' , user = null } = payload
        state.token = token
        cookie.set(`${state.token_name}` , token , { expires: 30 })
        state.user = user
    },
    logout(state){
        state.token = null 
        state.user  = null 
        cookie.remove(`${state.token_name}`)
        router.push({ name : 'Login' })
    },
    setLoading(state , payload ){
        state.is_loading = payload
    },
    setUser(state , payload ){
        state.user = payload
    },
    setBreadcrumb(state, payload){
        state.breadcrumb = payload
    }
}



