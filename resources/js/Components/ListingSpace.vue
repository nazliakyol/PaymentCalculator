<template>
    <span class="font-bold">{{ listing.beds }}</span> bds <span class="text-gray-400"> | </span>
    <span class="font-bold">{{ listing.baths }}</span> ba <span class="text-gray-400"> | </span>
    <span class="font-bold">{{ listing.area }}</span> m²
</template>

<script setup lang="ts">
defineProps({
    listing: Object,
});
</script>
