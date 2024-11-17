<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import Spinner from "@/Components/Spinner.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { ref } from "vue";

defineProps<{
    status?: string;
}>();

const loading = ref<boolean>(false);
</script>

<template>
    <GuestLayout>
        <Head title="Logout" />

        <div v-if="loading" class="flex flex-col items-center gap-5">
            <Spinner class="text-white" />
            <h3 class="text-white">Loading...</h3>
        </div>

        <div v-else>
            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                {{ status }}
            </div>

            <div>
                <div>
                    <h1 class="dark:text-white text-center">Logout</h1>
                </div>

                <div class="py-12">
                    <h3 class="dark:text-white text-center">Do you want to logout</h3>
                </div>

                <div class="flex justify-between">
                    <Link :href="route('dashboard')">
                        <SecondaryButton type="submit"> Home </SecondaryButton>
                    </Link>
                    <Link :href="route('logout')" method="post">
                        <PrimaryButton> Log Out </PrimaryButton>
                    </Link>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
