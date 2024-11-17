import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

// Export the Vite configuration
export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      'vue': 'vue/dist/vue.esm-bundler.js',
    },
  },
});

    