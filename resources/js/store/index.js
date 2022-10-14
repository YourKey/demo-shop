import {createStore} from 'vuex'

export default createStore({
    state () {
        return {
            cart: []
        }
    },
    mutations: {
        initialiseStore(state) {
            if(localStorage.getItem('store')) {
                this.replaceState(
                    Object.assign(state, JSON.parse(localStorage.getItem('store')))
                );
            }
        },
        addToCart(state, product) {
            const index = state.cart.findIndex(object => {
                return object.id === product.id;
            });
            if (index === -1) {
                product.amount = 1;
                state.cart.push(product)
            } else {
                state.cart[index].amount = state.cart[index].amount+1;
            }
        },
        clearCart(state) {
            state.cart = [];
            window.location.replace(window.location.origin);
        }
    },
    getters: {
        countProducts (state) {
            return state.cart.length
        }
    }
})
