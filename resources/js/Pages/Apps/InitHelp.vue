<script setup lang="ts">
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextLink from "@/Components/TextLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ClientModel } from "@/models/ClientModel";
import { Head, Link } from "@inertiajs/vue3";

defineProps<{
    client: ClientModel;
    secret?: string;
}>();
</script>

<template>
    <Head title="Configure your app" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Configure your app
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
                                {{ client.name }}
                            </h2>
                        </header>

                        <div class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="id" value="Client Id" />

                                <TextLink
                                    id="id"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :model-value="client.id"
                                />
                            </div>

                            <div>
                                <div class="flex items-center gap-4">
                                    <InputLabel
                                        for="authorize"
                                        value="Authorization URL"
                                    />
                                </div>

                                <TextLink
                                    id="authorize"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :model-value="route('passport.authorizations.authorize')"
                                />
                            </div>

                            <div>
                                <div class="flex items-center gap-4">
                                    <InputLabel
                                        for="token"
                                        value="Access token URL"
                                    />
                                </div>

                                <TextLink
                                    id="token"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :model-value="route('passport.token')"
                                />
                            </div>

                            <div>
                                <div class="flex items-center gap-4">
                                    <InputLabel
                                        for="resource"
                                        value="Resource URL"
                                    />
                                </div>

                                <TextLink
                                    id="resource"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :model-value="route('user.get')"
                                />
                            </div>

                            <div>
                                <div class="flex items-center gap-4">
                                    <InputLabel
                                        for="logout"
                                        value="Logout URL"
                                    />
                                </div>

                                <TextLink
                                    id="logout"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :model-value="route('oauth.logout')"
                                />
                            </div>

                            <div v-if="secret">
                                <div class="flex items-center gap-4">
                                    <InputLabel
                                        for="secret"
                                        value="Client Secret"
                                    />
                                    <p class="text-gray-400 text-sm">
                                        It will not be displayed later !
                                    </p>
                                </div>

                                <TextLink
                                    id="secret"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :model-value="secret"
                                />
                            </div>

                            <div>
                                <div class="flex items-center gap-4">
                                    <InputLabel value="Redirect URLs" />
                                    <p class="text-gray-400 text-sm">
                                        Select the URL where you want to
                                        redirect the user
                                    </p>
                                </div>

                                <div
                                    v-for="(
                                        redirect_urls, index
                                    ) in client.redirect_urls"
                                    :key="index"
                                >
                                    <TextLink
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="client.redirect_urls[index]"
                                    />
                                </div>
                            </div>

                            <div>
                                <Link :href="route('apps.index')">
                                    <SecondaryButton>Done</SecondaryButton>
                                </Link>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
