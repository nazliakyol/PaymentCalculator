<template>
        <h1>Listings</h1>
        <div v-for="listing in listings" :key="listing.id">
            <Link :href="`listing/${listing.id}`"> Apartment in
                <ListingAddress :listing="listing"/>
            </Link>
        </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import ListingAddress from "@/Components/ListingAddress.vue";
    defineProps(
        {
            listings: Array,
        }
    )

</script>
