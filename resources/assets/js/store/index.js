export default {
    state: {
        chat_status:true,
        with_id : null
    },
    getters: {
        getWithId(state){ //take parameter state
            return state.with_id
        }
    },
    mutations: {
        setStatus(state, status) {
            return state.chat_status = status
        },
        setWithId(state, id) {
            return state.with_id = id
        }
    },
    actions: {
        setChatStatus({ commit }, status){
            commit('setStatus',status)
        },
        setChatWithId({ commit }, id){
            commit('setWithId',id)
        }
    }
}