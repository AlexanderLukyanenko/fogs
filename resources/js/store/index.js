import Vue from 'vue';
import Vuex from 'vuex'
import popUp from "./modules/popUp";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        popUp
    }
})

