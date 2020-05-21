export default {
    state:{
        msg: '',
        msgStatus: false,
    },
    getters:{
        msg (state){
            return state.msg;
        },
        msgStatus (state){
            return state.msgStatus;
        }
    },
    mutations:{
        popUp (state, payload){
            state.msg = payload.msg;
            state.msgStatus = payload.msgStatus
        }
    },
    actions:{
        popUp ({commit, dispatch}, payload) {
            commit('popUp', payload);
        },

    }
}
