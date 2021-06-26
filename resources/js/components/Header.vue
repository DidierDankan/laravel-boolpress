<template>
    <div>
        <header class="container">
            <a href="#"> Logo Brand </a>
            <ul>
                <li>
                    <router-link :to="{ name: 'home' }">
                        Home
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'about' }">
                        About
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'blog' }">
                        Blog
                    </router-link>
                </li>
            </ul>
        </header>
    </div>
</template>

<script>
export default {
    name: "Header"
};
</script>

<style lang="scss"></style>
