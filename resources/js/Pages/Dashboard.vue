<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12 flex justify-center gap-5">
            <div v-for="client in user.clients" class="col-4">
                <a :href="client.redirect_urls[0]" target="_blank">
                    <div
                        class="flex flex-col items-center justify-center px-8 py-4 gap-2 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 hover:shadow-lg transition-all duration-300"
                    >
                        <img v-if="client.picture" :src="client.picture" :alt="`${client.name} picture`" class="h-20 w-20" />
                        <div
                            :class="`text-gray-900 dark:text-gray-100 cursor-pointer flex justify-center items-center ${!client.picture ? 'h-28 w-20' : ''}`"
                        >
                            {{ client.name }}
                        </div>
                    </div>
                </a>
            </div>
            <div v-if="user.clients.length === 0">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    No Application found
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
