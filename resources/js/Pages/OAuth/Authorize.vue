<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import Spinner from "@/Components/Spinner.vue";
import { ClientModel } from "@/models/ClientModel";
import { ref } from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const page = usePage();

defineProps<{
    status?: string;
    client: ClientModel;
    scopes?: string[];
    request?: Record<string, string | number | boolean>;
    authToken: string;
    state: string;
}>();

const form = useForm({});

const loading = ref<boolean>(false);
</script>

<template>
    <GuestLayout>
        <Head :title="client.name" />

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
                    <h1 class="dark:text-white text-center">{{ client.name }}</h1>
                </div>

                <div class="py-12">
                    <h3 class="dark:text-white text-center">Wants to connect with your account</h3>
                </div>

                <div class="flex justify-between">
                    <form method="POST" :href="route('passport.authorizations.deny')">
                        <input type="hidden" name="_token" :value="page.props.auth.csrf_token" autocomplete="off">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="state" :value="state">
                        <input type="hidden" name="client_id" :value="client.id">
                        <input type="hidden" name="auth_token" :value="authToken">
                        <SecondaryButton type="submit"> Cancel </SecondaryButton>
                    </form>
                    <form method="POST" :href="route('passport.authorizations.approve')">
                        <input type="hidden" name="_token" :value="page.props.auth.csrf_token" autocomplete="off">
                        <input type="hidden" name="state" :value="state">
                        <input type="hidden" name="client_id" :value="client.id">
                        <input type="hidden" name="auth_token" :value="authToken">
                        <PrimaryButton> Authorize </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
