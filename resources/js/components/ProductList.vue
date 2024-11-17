<template>
  <div>
    <div v-if="categories.length">
      <h3>Categories</h3>
      <ul>
        <li v-for="category in categories" :key="category.id">{{ category.name }}</li>
      </ul>
    </div>
    <div v-if="initialProducts.length">
      <h3>Products</h3>
      <ul>
        <li v-for="product in initialProducts" :key="product.id">{{ product.name }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    categories: Array,
    initialProducts: Array,
    pagination: Object
  },
};
</script>
