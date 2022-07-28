import {ref} from 'vue';
import axios from "axios";

export function usePosts(){

    let posts = ref([])

    const getPosts = async () =>{
        let response = await axios.get('/api/posts');
        posts.value = response.data.data;
    }

    return {
        posts,
        getPosts
    }
}
