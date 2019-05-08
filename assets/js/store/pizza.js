import pizzaApi from '../api/pizza';
import {getByKeyword} from '../util/filter';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        pizzas: [],
        keyword: '',
    },
    getters: {
        isLoading (state) {
            return state.isLoading;
        },
        hasError (state) {
            return state.error !== null;
        },
        error (state) {
            return state.error;
        },
        hasPizzas (state) {
            return state.pizzas.length > 0;
        },
        pizzas (state) {
            return state.pizzas;
        },
        filterByKeyword (state) {
            return getByKeyword(state.pizzas, state.keyword);
        }
    },
    mutations: {
        ['FETCHING_PIZZAS'](state) {
            state.isLoading = true;
            state.error = null;
            state.pizzas = [];
        },
        ['FETCHING_PIZZAS_SUCCESS'](state, pizzas) {
            state.isLoading = false;
            state.error = null;
            state.pizzas = pizzas;
        },
        ['FETCHING_PIZZAS_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.pizzas = [];
        }
    },
    actions: {
        fetchPizzas ({commit}) {
            commit('FETCHING_PIZZAS');
            return pizzaApi.getAll()
                .then(res => commit('FETCHING_PIZZAS_SUCCESS', res.data))
                .catch(err => commit('FETCHING_PIZZAS_ERROR', err));
        }
    },
}