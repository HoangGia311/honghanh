export default {
    async GET({commit}, payload){
        let { current_page = 1 , limit = 10 , keyword = ''  } = payload
        return await axios.get('/api/users' ,  {params : { current_page , limit , keyword } })
    },
    
}