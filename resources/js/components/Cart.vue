<template>
    <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle">
            <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                <span class="badge badge-sm indicator-item">{{ this.$store.getters.countProducts }}</span>
            </div>
        </label>
        <div tabindex="0" class="mt-3 card card-compact dropdown-content w-64 bg-base-100 shadow">
            <div class="card-body">
                <span class="font-bold text-lg">{{ this.$store.getters.countProducts }} товаров</span>
                <div v-for="product in this.$store.state.cart" :key="product.id" class="text-info">{{ product.name }} × {{ product.amount }} шт</div>
                <div class="card-actions">
                    <form method="POST" action="/cart">
                        <input name="cart" type="hidden" :value="cartJson">
                        <input name="_token" type="hidden" :value="token">
                        <button type="submit" class="btn btn-primary btn-block">Оформить заказ</button>
                    </form>
                    <div class="mt-4">
                        <button @click.prevent="this.$store.commit('clearCart')" class="btn btn-sm btn-error">очистить корзину</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Cart",
    data() {
        return {
            token: null,
        }
    },
    computed: {
      cartJson() {
          return JSON.stringify(this.$store.state.cart);
      }
    },
    mounted() {
        this.token = document.querySelector('meta[name="token"]').content;
    },
    beforeCreate() {
        this.$store.commit('initialiseStore');
    }
}
</script>

<style scoped>

</style>
