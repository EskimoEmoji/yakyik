import './bootstrap';

import { createApp } from "vue";
import ProductsGrid from "./components/ProductsGrid.vue";

const app = createApp({})
app.component('products-grid',ProductsGrid);
app.mount('#app');
