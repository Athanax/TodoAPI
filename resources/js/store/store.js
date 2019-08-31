import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersist from 'vuex-persist';

Vue.use(Vuex);

const vuexPersist = new VuexPersist({
	key: 'Too_API',
	storage: window.localStorage,
})

export const store = new Vuex.Store({
	plugins: [vuexPersist.plugin],
	state: {
		products: [
			{ 'name': 'athanas', age: 12 },
			{ 'name': 'wambua', age: 23 },
			{ 'name': 'musyoka', age: 55 },
			{ 'name': 'faith', age: 20 }
		],

		count: 2,
		accessToken: '',
	},

	// a getter is used to make changes in the store
	getters: {
		getterProducts: state => {
			var saleProducts = state.products.map(product => {
				return {
					name: '**' + product.name + '**',
					age: product.age / 2,
				}
			});

			return saleProducts;
		}
	},

	mutations: {
		increment(state, amount) {
			state.count += amount
		},

		setToken(state, token){
			state.accessToken = token
		}
	},

	actions: {

		// we can define an action here with parameter context refering to the store
		incrementAction: (context, amount) => {
			setTimeout(
				function () {
					context.commit('increment', amount);
				}
				, 3000)
		},

		setTokenAction: (context, token)=>{
			context.commit('setToken', token)
		}
	}
})