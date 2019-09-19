
const state = {
	gallery : []
};

const getters = {
	get(state){
		return state.gallery
	}
};

const actions = {
    get({commit} , payload){
		return new Promise(function(resolve, reject) {
			axios.get('/api/gallery').then((res)=>{
				let { code , data } = res.data 
				if( code ){
					commit('set' , data)
				}else{
					commit('set' , [])
				}
				resolve(res)
			})
		});
	},
	async create({commit} , payload){
		return await  axios.post('/api/gallery' , payload)
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