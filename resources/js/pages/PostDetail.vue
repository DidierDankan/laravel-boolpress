<template>
    <div class="container">
        for now is empty
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "PostDetail",
    data() {
        return {
            postDetail: []
        };
    },
    created() {
        this.getPostDetail();
    },
    methods: {
        getPostDetail() {
            console.log("api here");
            axios
                .get(
                    `http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`
                )
                .then(res => {
                    this.postDetail = res.data.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style></style>
