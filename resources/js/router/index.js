import {createRouter, createWebHistory} from "vue-router";

import Posts from "../components/Posts";
import Companies from "../components/CompaniesIndex";

const routes = [
    {
        path: '/posts',
        name: 'posts.index',
        component: Posts,
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
