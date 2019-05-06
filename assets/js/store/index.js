import Vue from 'vue';
import Vuex from 'vuex';
import PizzaModule from './pizza';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        pizza: PizzaModule,
    }
});