
const state = {

};

const getters = {

};

const actions = {
    async list({}, payload){
        let { page = 1 , limit = 10 , keyword = ''  } = payload
        return await axios.get('/api/posts' ,  {params : { page , limit , keyword } })
    },
    async create({}, payload){
        return await axios.post('/api/posts' ,  payload )
    },
    async update({}, payload){
        let { id ,  formdata  } = payload
        return await axios.put(`/api/posts/${id}` ,  formdata )
    },
    async delete({}, payload){
        return await axios.delete(`/api/posts/${payload}`);
    },
    async get({ } , payload){
        return await axios.get(`/api/posts/${payload}/edit`)
	},
	async getCreate({}, payload){
        return await axios.get('/api/posts/create' )
    },
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