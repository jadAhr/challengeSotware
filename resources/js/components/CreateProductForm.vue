<template>
    <div id="creat">
      <form @submit.prevent="submitForm">
        <input v-model="product.name" type="text" placeholder="Product Name" required />
        <textarea v-model="product.description" placeholder="Product Description" required></textarea>
        <input v-model="product.price" type="number" step="0.01" placeholder="Price" required />
        <input type="file" @change="handleImageUpload" required />
        <select v-model="product.categories" multiple>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
        <button type="submit">Create Product</button>
      </form>
  
      <div v-if="errors.length">
        <ul>
          <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        product: {
          name: '',
          description: '',
          price: '',
          image: null,
          categories: [],
        },
        categories: [],
        errors: [],
      };
    },
    mounted() {
      this.fetchCategories();
    },
    methods: {
      fetchCategories() {
        fetch('/api/categories')
          .then(response => response.json())
          .then(data => {
            this.categories = data;
          });
      },
      handleImageUpload(event) {
        this.product.image = event.target.files[0];
      },
      submitForm() {
        const formData = new FormData();
        formData.append('name', this.product.name);
        formData.append('description', this.product.description);
        formData.append('price', this.product.price);
        formData.append('image', this.product.image);
        this.product.categories.forEach(category => {
          formData.append('categories[]', category);
        });
  
        fetch('/products', {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Product created successfully');
              return location.replace("http://localhost:8000/")
              this.resetForm();
            } else {
              this.errors = data.errors || ['Something went wrong'];
            }
          })
          .catch(error => {
            this.errors = [error.message];
          });
      },
      resetForm() {
        this.product.name = '';
        this.product.description = '';
        this.product.price = '';
        this.product.categories = [];
        this.product.image = null;
      },
    },
  };
  </script>
  
  <style scoped>
  #creat {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  
  form {
    display: flex;
    flex-direction: column;
    width: 600px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  }
  
  input,
  textarea,
  select,
  button {
    margin: 10px 0;
    padding: 10px;
    font-size: 16px;
    border-radius: 8px;
  }
  
  button {
    background-color: #4caf50;
    color: white;
    border: none;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #45a049;
  }
  
  ul {
    color: red;
  }
  </style>
  