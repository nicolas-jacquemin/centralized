<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Table } from "@dootix-developer/inertiajs-tables-laravel-query-builder";
import { Head, Link } from "@inertiajs/vue3";

defineProps(["apps"]);
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
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Table :resource="apps">
                    <template #cell(actions)="{ item: app }">
                        <Link :href="route('apps.edit', app.id)">
                          Edit
                        </Link>
                    </template>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
