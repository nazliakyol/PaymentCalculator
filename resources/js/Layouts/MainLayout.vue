<template>
    <Link href="/">Index Page</Link>&nbsp;
    <Link href="/show">Show Page</Link>
<!--    <div> the page with time {{ counter }}</div>-->
    <div v-if="flashSuccess" class="success"> {{ flashSuccess }}</div>
<!--    <div> {{ x }} </div>-->
    <slot></slot>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const x = ref(0);
const y = computed(() => x.value * 2);
const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);

// const counter = ref(0);
// setInterval(() => {
//     counter.value++;
// }, 1000);

</script>

<style scoped>
    .success {
        background-color: green;
        color: white;
    }
</style>
