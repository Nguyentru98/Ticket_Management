<script setup>
import Navbar from "@/layout/Navbar.vue";
import Footer from '@/layout/Footers.vue'
</script>

<template>
    <div class="wrapper ">
        <Navbar></Navbar>
        <main>
            <router-view/>
        </main>
        <!-- <Footer></Footer> -->
    </div>
</template>

<style>
.wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1;
}
</style>
