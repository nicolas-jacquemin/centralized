<script setup>
import AppsMarketplace from "@/Components/AppsMarketplace.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Table } from "@dootix-developer/inertiajs-tables-laravel-query-builder";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps(["apps"]);

const marketplace = ref(false);

const appSelected = (app) => {
    router.get(route("apps.create"), app);
    marketplace.value = false;
};
</script>

<template>
    <Head title="Apps" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Apps
            </h2>
            <div class="flex flex-1"></div>
            <PrimaryButton @click="marketplace = true"
                >Preconfigured Apps</PrimaryButton
            >
            <Link :href="route('apps.create')">
                <PrimaryButton :href="route('apps.create')"
                    >Create App</PrimaryButton
                >
            </Link>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Table :resource="apps">
                    <template #cell(actions)="{ item: app }">
                        <Link :href="route('apps.edit', app.id)"> Edit </Link>
                    </template>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
    <Modal :show="marketplace" @close="marketplace = false">
        <AppsMarketplace @app-selected="appSelected" />
    </Modal>
</template>
