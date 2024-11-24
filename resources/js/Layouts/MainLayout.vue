<template>
    <Link href="/">Index Page</Link>&nbsp;
    <Link href="/show">Show Page</Link>
    <div> the page with time {{ counter }}</div>
    <slot></slot>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const counter = ref(0);
setInterval(() => {
    counter.value++;
}, 1000);

</script>
