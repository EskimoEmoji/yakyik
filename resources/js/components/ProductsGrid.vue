<template>
<!--    <div v-for="post in posts" class="font-bold text-white">-->

<!--        <div>-->
<!--            {{post.text}}-->
<!--        </div>-->
<!--    </div>-->
    <div v-for="post in posts" class="text-white">

        <div class="card lg:w-1/4 md:w-1/2 mx-auto mb-3 shadow-md">

            {{post.text}}
        </div>
    </div>

</template>

<script setup>
    import {onMounted} from "vue";
    import { usePosts } from "../composables/posts.js";

    let {posts, getPosts} = usePosts();

    onMounted(()=>{
        getPosts();
    });


</script>
