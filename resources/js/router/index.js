import {createRouter, createWebHistory} from "vue-router";

import Posts from "../components/Posts";

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
