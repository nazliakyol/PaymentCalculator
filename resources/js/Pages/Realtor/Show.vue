<template>
    <div class="mb-4">
        <Link
            :href="route('realtor.listing.index')">
            ← Go back to listings
        </Link>
    </div>
    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="flex :col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No offers
            </div>
        </Box>
        <div v-else class="md:col-span-7 flex flex-col gap-4">
            <Offer
                :offer="offer"
                v-for="offer in listing.offers"
                :key="offer.id"
                :listing-price="listing.price"
            />
        </div>
        <div class="md:col-span-5">
            <Box>
                <template #header>Basic Info</template>
                <Price :price="listing.price" class="text-2xl font-bold"/>
                <ListingSpace :listing="listing" class="text-lg"/>
                <ListingAddress :listing="listing" class="text-gray-500"/>
            </Box>
        </div>
    </section>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import {computed} from "vue";
import Offer from "@/Pages/Realtor/Show/Components/Offer.vue";

const props = defineProps({
    listing: Object,
})

const hasOffers = computed(
    () => props.listing?.offers?.length
);
</script>
