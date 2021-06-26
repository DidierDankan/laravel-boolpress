<template>
    <div class="container">
        <h1>Posts</h1>
        <div v-if="posts">
            <article v-for="post in posts" :key="post.id">
                <h2>{{ post.title }}</h2>
                <div>{{ formatDate(post.created_at) }}</div>
                <router-link
                    :to="{ name: 'post-detail', params: { slug: post.slug } }"
                    >Read more
                </router-link>
            </article>
        </div>

        <div v-else>
            Loading...
        </div>

        <section class="navigation">
            <button
                v-show="pages.current > 1"
                @click="getPosts(pages.current - 1)"
            >
                prev
            </button>
            <button
                v-for="i in pages.last"
                :key="`page${i}`"
                @click="getPosts(i)"
                :class="{ 'active-page': i == pages.current }"
            >
                {{ i }}
            </button>
            <button
                v-show="pages.current < pages.last"
                @click="getPosts(pages.current + 1)"
            >
                next
            </button>
        </section>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Blog",
    data() {
        return {
            posts: null,
            pages: []
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then(res => {
                    // console.log(res.data.posts);
                    this.posts = res.data.data;
                    this.pages = {
                        current: res.data.current_page,
                        last: res.data.last_page
                    };
                })
                .catch(err => {
                    console.log(err);
                });
        },
        formatDate(date) {
            const postDate = new Date(date);
            let day = postDate.getDate();
            let month = postDate.getMonth() + 1;
            const year = postDate.getFullYear();

            if (day < 10) {
                day = "0" + day;
            }

            if (month < 10) {
                month = "0" + month;
            }

            return `${day}/${month}/${year}`;
        }
    }
};
</script>

<style></style>
