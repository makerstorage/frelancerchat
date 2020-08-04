export default {
    state: {
        chat_status:true
    },
    getters: {
        getChatStatus(state){ //take parameter state
            return state.chat_status
        }
    },
    mutations: {
        setStatus(state, status) {
            return state.chat_status = status
        }
    },
    actions: {
        setChatStatus({ commit }, status){
            commit('setStatus',status)
        }
    }
}