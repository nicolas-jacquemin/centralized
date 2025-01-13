<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Table } from "@dootix-developer/inertiajs-tables-laravel-query-builder";
import { Head, Link } from "@inertiajs/vue3";

defineProps(["users"]);
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Users
            </h2>
            <div class="flex flex-1"></div>
            <Link :href="route('users.create')">
                <PrimaryButton :href="route('users.create')"
                    >Create User</PrimaryButton
                >
            </Link>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Table :resource="users">
                    <template #cell(actions)="{ item: user }">
                        <Link :href="route('users.edit', user.id)"> Edit </Link>
                    </template>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
