<template>
    <div class="text-white font-bold">Hello Vue</div>
    <div v-for="post in posts" class="text-white">

        <div class="card lg:w-1/4 md:w-1/2 mx-auto mb-3 shadow-md">


            {{post.text}}

            <div class="flex justify-center items-center">
                <div v-if="post.user_votes[0] != null">
                    <div v-if="post.user_votes[0].vote == -1">
                        <button type="submit" class="px-1">👎</button>
                    </div>
                    <div v-else>
                        <button type="submit" class="px-1">∇</button>
                    </div>
                </div>
                <div v-else>
                    <button type="submit" class="px-1">∇</button>
                </div>

                <div v-if="post.votes_sum_vote != 0" class="px-2 font-bold text-sm">{{post.votes_sum_vote}}</div>
                <div v-else>0</div>
            </div>


        </div>
    </div>

</template>

<script setup>
    import {onMounted} from "vue";
    import { usePosts } from "../composables/posts.js";

    let {posts, getPosts, destroyPost} = usePosts();

    onMounted(()=>{
        getPosts();
    });

    const deletePost = async (id) =>{
        await destroyPost(id);
        await getPosts();
    }
</script>
