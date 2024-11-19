import "./bootstrap";
import { createApp } from 'vue';
import App from "./components/App.vue";
import ProductsList from "./components/ProductsList.vue";
import CreateProductForm from "./components/CreateProductForm.vue";

// Create and mount the Vue app
createApp(App).mount("#app");
createApp(ProductsList).mount("#products")
createApp(CreateProductForm).mount("#create")






