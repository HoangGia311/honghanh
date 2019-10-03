
const state = {

};

const getters = {

};

const actions = {
	async get({ }){
        return await axios.get(`/api/page/listComponent`)
	},
	async pages({ } , payload){
        return await axios.get(`/api/page`)
	},
	async create({}, payload){
        return await axios.post('/api/page/addComponents',  payload )
    },
    async update({}, payload){
        let { id ,  formdata  } = payload
        return await axios.put(`/api/cooking/${id}` ,  formdata )
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