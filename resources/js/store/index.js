import Vue from 'vue';
import Vuex from 'vuex';
import dsAdmin from './modules/dsAdmin';
import mdGeneral from './modules/mdGeneral';
Vue.use(Vuex);


const store = new Vuex.Store({
    state:{

    },
    mutations:{

    },
    actions:{

    },
    modules:{
        dsAdmin,
        mdGeneral
    }
});

export default store;