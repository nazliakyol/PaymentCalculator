<template>
    <span>
        {{ listing.city }}, {{ listing.street }} for {{ listing.price }}€
    </span>
</template>
<script setup lang="ts">
    defineProps({
        listing: Object,
    });
</script>
