<script setup lang="ts">
import IconButton from "@/Components/IconButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    redirect_urls: [""],
});

const submit = () => {
    form.post(route("apps.store"));
};
</script>

<template>
    <Head title="New App" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                New App
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
                >
                    <section>
                        <header>
                            <h2
                                class="text-lg font-medium text-gray-900 dark:text-gray-100"
                            >
                                General Information
                            </h2>

                            <p
                                class="mt-1 text-sm text-gray-600 dark:text-gray-400"
                            >
                                Basic information about this app
                            </p>
                        </header>

                        <form @submit.prevent="submit" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>

                            <div>
                                <InputLabel value="Redirect URLs" />

                                <div
                                    v-for="(
                                        redirect_urls, index
                                    ) in form.redirect_urls"
                                    :key="index"
                                >
                                    <div class="flex items-center gap-4">
                                        <IconButton
                                            v-if="
                                                index ===
                                                form.redirect_urls.length - 1
                                            "
                                            icon="plus"
                                            class="dark:bg-gray-900 dark:hover:bg-gray-700 dark:text-white"
                                            :size="20"
                                            @click="form.redirect_urls.push('')"
                                        />
                                        <IconButton
                                            v-if="form.redirect_urls.length > 1"
                                            icon="minus"
                                            class="dark:bg-gray-900 dark:hover:bg-gray-700 dark:text-white"
                                            :size="20"
                                            @click="
                                                form.redirect_urls.splice(
                                                    index,
                                                    1
                                                )
                                            "
                                        />
                                        <TextInput
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.redirect_urls[index]"
                                        />
                                    </div>
                                    <InputError
                                        class="mt-2"
                                        :message="((form.errors) as Record<string, string>)[`redirect_urls.${index}`]"
                                    />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing"
                                    >Create</PrimaryButton
                                >
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
