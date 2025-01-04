<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 ">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>&nbsp;
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                    <Link :href="route('listing.index')">LaraZillow</Link>&nbsp;
                </div>
                <div>
                    <div v-if="user" class="flex items-center gap-4">
                        <Link
                            class=" text-sm text-gray-500"
                            :href="route('realtor.listing.index')">
                            {{ user.name }}
                        </Link>
                        <Link :href="route('realtor.listing.create')"
                              class="btn-primary">
                            + New Listing
                        </Link>&nbsp;
                        <div>
                            <Link :href="route('logout')" method="DELETE" as="button">Logout</Link>
                        </div>
                    </div>
                    <div v-else class="flex items-center gap-2">
                        <Link :href="route('user-account.create')">Register</Link>
                        <Link :href="route('login')">Login</Link>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess"
             class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
            {{ flashSuccess }}
        </div>
        <slot>Default</slot>
    </main>
</template>

<script setup>
import {Link, usePage, useForm} from '@inertiajs/vue3';
import {ref, computed} from 'vue';

const x = ref(0);
const y = computed(() => x.value * 2);
const page = usePage();
const user = computed(
    () => page.props.user
);

const flashSuccess = computed(() => page.props.flash.success);
</script>
