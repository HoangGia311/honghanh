import cookie from 'js-cookie'
let token_name = process.env.VUE_APP_TOKEN_NAME ? process.env.VUE_APP_TOKEN_NAME : 'token'
let token = cookie.get(token_name)
const state = {
	gallery : []
};

const getters = {
	get(state){
		return state.gallery
	}
};

const actions = {
    async list({}, payload){
        let { page = 1 , limit = 10 ,} = payload
        return await axios.get('/api/image' ,  {params : { page , limit  } })
    },
	async upload({commit} , payload){
		return await  axios.post('/api/image' , payload , {
			headers: {
				'Content-Type': 'multipart/form-data',
				"Authorization": token
			}
		})
    }
};

const mutations = {
    set(state , payload){
		state.gallery = payload
	}
};
export default {
    state,
    actions,
    mutations,
    getters,
    namespaced: true,
};