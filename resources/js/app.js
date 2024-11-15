// resources/js/app.js

import { createApp } from 'vue';
import CategoriesList from './components/CategoriesList.vue';  // Import the Vue component

const app = createApp({});

// Register the component globally
app.component('categories-list', CategoriesList);

app.mount('#app');  // Mount Vue to the root element

