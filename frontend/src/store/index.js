import Vue from 'vue'
import Vuex from 'vuex'
import modules from "./modules";
Vue.use(Vuex)

const state = {
    is_loading : false,
}


const getters = {
    getLoading(state){
        return state.is_loading
    },
};

const actions = {
    
};

const mutations = {
    setLoading(state , payload ){
        state.is_loading = payload
    },
};
export default new Vuex.Store({
    state,
    actions,
    getters,
    mutations,
    modules
});