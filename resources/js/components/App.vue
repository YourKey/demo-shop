<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-x-10 gap-y-14 mt-4">
        <div v-for="product in products" :key="product.id" class="card bg-base-100 shadow-xl">
            <product-card :init-product="product"></product-card>
        </div>
    </div>
</template>

<script>
import ProductCard from "./ProductCard";

export default {
    name: "App",
    components: { ProductCard },
    data: () => ({
        products: [],
    }),
    mounted() {
        axios.get('/api/v1/products'+window.location.search)
        .then(response => {
            this.products = response.data.data;
        }).catch(error => {
            console.log('request error:')
            console.log(error)
        });
    },
    beforeCreate() {
        this.$store.commit('initialiseStore');
    }
}
</script>

<style scoped>

</style>
