<template>
    <div class="container">
      <h1>Products</h1>
      
      <!-- Filter and Sort -->
      <div class="filters">
        <select v-model="selectedCategory" @change="fetchProducts">
            <option value="">All Categories</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
             {{ category.name }}
            </option>
        </select>

  
        <select v-model="sortByPrice" @change="fetchProducts">
          <option value="">Sort by Price</option>
          <option value="asc">Low to High</option>
          <option value="desc">High to Low</option>
        </select>
        <a href="http://localhost:8000/products/create">Add New Products</a>
      </div>
  
      <!-- Products Grid -->
      <div class="row">
        <div class="col-md-4" v-for="product in products" :key="product.id">
          <div class="card">
            <img :src="`/storage/${product.image}`" class="card-img-top" :alt="product.name">
            <div class="card-body">
              <h5 class="card-title">{{ product.name }}</h5>
              <p class="card-text">{{ product.description }}</p>
              <p><strong>${{ product.price.toFixed(2) }}</strong></p>
              <p>
                Categories: 
                <span v-for="category in product.categories" :key="category.id" class="badge bg-secondary">
                  {{ category.name }}
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
  data() {
    return {
      products: [],
      categories: [],
      selectedCategory: "",
      sortByPrice: "",
    };
  },
  methods: {
    fetchProducts() {
      let url = "/api/products";

      const params = {};
      if (this.selectedCategory) {
        params.category = this.selectedCategory; // Send the selected category as a parameter
      }
      if (this.sortByPrice) {
        params.sort_by_price = this.sortByPrice;
      }

      axios.get(url, { params }).then((response) => {
        this.products = response.data;
      });
    },
    fetchCategories() {
      axios.get("/api/categories").then((response) => {
        this.categories = response.data;
      });
    },
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
  },
};
  </script>
  
  <style scoped>
  .filters {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
    
  }
  .row{

    display: grid;
    grid-template-columns: auto auto auto;
    place-items: center;
  }
  .card-img-top{
    width: 300px;
  }


 
  </style>
  
  