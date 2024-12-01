<template>
    <span>
        {{ listing.city }}, {{ listing.street }}
    </span>
</template>
<script setup lang="ts">
    defineProps({
        listing: Object,
    });
</script>
