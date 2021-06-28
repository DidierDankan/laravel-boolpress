<template>
    <div class="container">
        <h2>
            {{ postDetail.title }}
        </h2>
        <span
            v-if="
                postDetail.category !== undefined &&
                    postDetail.category !== null
            "
        >
            {{ postDetail.category.name }}
        </span>
        <span v-for="tag in postDetail.tags" :key="`tag-${tag.id}`">
            {{ tag.name }}
        </span>

        <p>
            {{ postDetail.content }}
        </p>
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
            axios
                .get(
                    `http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`
                )
                .then(res => {
                    this.postDetail = res.data;
                    console.log(this.postDetail);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style></style>
