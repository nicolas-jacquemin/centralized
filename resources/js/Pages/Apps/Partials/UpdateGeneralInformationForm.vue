<script setup lang="ts">
import DangerButton from "@/Components/DangerButton.vue";
import IconButton from "@/Components/IconButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps<{
    client: any;
    mustVerifyEmail?: Boolean;
    status?: String;
    secret?: string;
}>();

const form = useForm({
    name: props.client.name,
    redirect_urls: props.client.redirect_urls,
});

const deleteApp = () => {
    form.delete(route("apps.destroy", props.client.id));
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                General Information
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Basic information about this app
            </p>
        </header>

        <form
            @submit.prevent="form.put(route('apps.update', client.id))"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="id" value="Client Id" />

                <TextInput
                    id="id"
                    type="text"
                    class="mt-1 block w-full"
                    :model-value="client.id"
                    disabled
                />
            </div>

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

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel value="Redirect URLs" />

                <div
                    v-for="(redirect_urls, index) in form.redirect_urls"
                    :key="index"
                    class="flex items-center gap-4"
                >
                    <IconButton
                        v-if="index === form.redirect_urls.length - 1"
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
                        @click="form.redirect_urls.splice(index, 1)"
                    />
                    <TextInput
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.redirect_urls[index]"
                    />
                </div>

                <InputError class="mt-2" :message="form.errors.redirect_urls" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                <DangerButton @click="deleteApp" :disabled="form.processing"
                    >Delete</DangerButton
                >

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
