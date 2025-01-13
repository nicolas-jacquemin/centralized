<script setup lang="ts">
import SecondaryButton from "@/Components/SecondaryButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <GuestLayout>
        <Head title="Unauthorized" />

        <div class="flex flex-col items-center gap-5">
            <h3 class="dark:text-white">Unauthorized</h3>
            <p class="dark:text-white">You have not access to this app</p>
            <Link :href="route('dashboard')">
                <SecondaryButton type="submit"> Home </SecondaryButton>
            </Link>
        </div>
    </GuestLayout>
</template>
