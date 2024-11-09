<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();
</script>

<template>
    <GuestLayout>
        <Head title="Home" />
        <nav v-if="canLogin" class="mx-3 flex flex-col">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white w-full"
            >
                <PrimaryButton class="w-full justify-center">
                    Dashboard
                </PrimaryButton>
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white w-full"
                >
                    <PrimaryButton class="w-full justify-center">
                        Log in
                    </PrimaryButton>
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white w-full"
                >
                    <PrimaryButton class="w-full justify-center">
                        Register
                    </PrimaryButton>
                </Link>
            </template>
        </nav>
    </GuestLayout>
</template>
