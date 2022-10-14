import { createApp } from "vue";
import App from './components/App'
import Cart from "./components/Cart";
import store from "./store";

require("./bootstrap");


store.subscribe((mutation, state) => {
    localStorage.setItem('store', JSON.stringify(state));
});

const productsApp = createApp(App);
productsApp.use(store);
productsApp.mount('#products');

const cartApp = createApp(Cart);
cartApp.use(store);
cartApp.mount('#cart');
