<script setup>
import Navbar from './layout/Navbar.vue'
import Footer from './layout/Footers.vue'
</script>

<template>
    <div class="wrapper container">
        <div>
            <Navbar></Navbar>
        </div>
        <main class="border">
            <router-view/>
        </main>
        <div>
            <Footer></Footer>
        </div>
    </div>
</template>

<style scoped>
.wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1;
}
</style>
