<template>
    <h1>Listing</h1>
    <div v-bind="listing">
        <ListingAddress :listing="listing"/>
    </div>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";

defineProps(
    {
        listing: Object,
    }
)

</script>
