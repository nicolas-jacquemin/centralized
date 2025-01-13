<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdateGeneralInformationForm from "./Partials/UpdateGeneralInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps(["user", "roleEditable", "clients"]);
</script>

<template>
    <Head :title="`${user.name}`" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                User
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
                >
                    <UpdateGeneralInformationForm
                        :user="user"
                        :role-editable="roleEditable"
                        class="max-w-xl"
                        :clients="clients"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
