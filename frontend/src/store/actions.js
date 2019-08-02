export default {
    LOGIN({ commit } ,  payload){
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
    LOGOUT({commit}){
        commit('logout')
    },
    GET_USER({commit}){
        return new Promise(function(resolve, reject) {
            axios.post('/api/user')
            .then(function (res) {
                let { code , data } = res.data 
                if( code ){
                    // commit('login', data)
                }
                resolve(res)
            })
            .catch(function (err) {
                reject(err)
            });
        });
    }
}