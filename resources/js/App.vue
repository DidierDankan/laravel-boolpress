<template>
    <div>
        <header>
            header
        </header>
        <main>
            <div class="container">
                <h1>Posts</h1>

                <article v-for="post in posts" :key="post.id">
                    <h2>{{ post.title }}</h2>
                    <div>{{ formatDate(post.created_at) }}</div>
                    <a href="#">Read more</a>
                </article>
            </div>
        </main>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "App",
    data() {
        return {
            posts: []
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios
                .get("http://127.0.0.1:8000/api/posts")
                .then(res => {
                    // console.log(res.data.posts);
                    this.posts = res.data.posts;
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

<style lang="scss">
@import "../sass/partials/main.scss";

body {
    font-family: sans-serif;
}
</style>
