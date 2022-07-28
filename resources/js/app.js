import './bootstrap';

import { createApp } from "vue";
import router from "./router/index.js";
import Posts from "./components/Posts.vue";
import ProductsGrid from "./components/ProductsGrid.vue";
import CompaniesIndex from "./components/CompaniesIndex.vue";

// createApp({
//     components:{
//         Posts
//     }
// }).use(router).mount('#app')
const app = createApp({})
app.component('products-grid',ProductsGrid);
app.component('companies-Index',CompaniesIndex);
app.mount('#app');
