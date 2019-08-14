
const state = {

};

const getters = {

};

const actions = {
    async list({}, payload){
        let { page = 1 , limit = 10 , keyword = ''  } = payload
        return await axios.get('/api/categories' ,  {params : { page , limit , keyword } })
    },
    async create({}, payload){
        return await axios.post('/api/categories' ,  payload )
    },
    async update({}, payload){
        let { id ,  name , password , email } = payload
        return await axios.put(`/api/categories/${id}` ,  { name  , email } )
    },
    async delete({}, payload){
        return await axios.delete(`/api/categories/${payload}`);
    },
    async get({ } , payload){
        return await axios.get(`/api/categories/${payload}/edit`)
    }
};

const mutations = {
    
};
export default {
    state,
    actions,
    mutations,
    getters,
    namespaced: true,
};