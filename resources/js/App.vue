<script setup>
import Navbar from './layout/Navbar.vue'
</script>

<template>
    <div>
       <Navbar></Navbar>
    </div>
    <main>
        <router-view/>
    </main>
</template>

<style scoped>
ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

</style>
