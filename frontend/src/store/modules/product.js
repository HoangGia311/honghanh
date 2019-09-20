
const state = {

};

const getters = {

};

const actions = {
    async list({}, payload){
        let { page = 1 , limit = 10 , keyword = ''  } = payload
        return await axios.get('/api/product' ,  {params : { page , limit , keyword } })
    },
    async create({}, payload){
        return await axios.post('/api/product' ,  payload )
    },
    async update({}, payload){
        let { id ,  formdata  } = payload
        return await axios.put(`/api/product/${id}` ,  formdata )
    },
    async delete({}, payload){
        return await axios.delete(`/api/product/${payload}`);
    },
    async get({ } , payload){
        return await axios.get(`/api/product/${payload}/edit`)
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