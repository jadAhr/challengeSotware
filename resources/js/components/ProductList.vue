<template>
    <div>
        <h1>Product List</h1>
        
        <!-- Loading message -->
        <div v-if="loading">Loading...</div>
        
        <!-- Products list -->
        <div v-else>
            <div v-for="product in products" :key="product.id" class="product">
                <img :src="`/storage/${product.image}`" alt="product image" class="product-image" />
                <h2>{{ product.name }}</h2>
                <p>{{ product.description }}</p>
                <p>{{ product.price }}$</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'; // Make sure to import axios

export default {
    data() {
        return {
            products: [],
            loading: true,
        };
    },
    mounted() {
        this.fetchProducts(); // Fetch products when the component is mounted
    },
    methods: {
        // This method will fetch the products from the API
        fetchProducts() {
            axios.get('/api/products') // Make the GET request to fetch the products
                .then(response => {
                    this.products = response.data; // Store the response data
                    this.loading = false; // Hide the loading message
                })
                .catch(error => {
                    console.error('Error fetching products:', error); // Log any errors
                    this.loading = false; // Hide the loading message even if there's an error
                });
        }
    }
}
</script>

<style scoped>
/* Add any styles you need for your component */
.product {
    margin-bottom: 20px;
}

.product img {
    width: 200px;
    height: auto;
}
</style>
