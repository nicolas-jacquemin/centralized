<script setup lang="ts">
import { ref } from "vue";

const apps = ref([
    {
        picture: "https://dev.pve-fsn1.nicojqn.fr/picture/portainer.svg",
        name: "Portainer",
        redirect_urls: "https://<portainer-url>/",
    },
    {
        picture:
            "https://dev.pve-fsn1.nicojqn.fr/picture/outline.png",
        name: "Outline",
        redirect_urls: "https://<outline-url>/auth/oidc.callback",
    },
]);

const emits = defineEmits(["appSelected"]);
</script>

<template>
    <div class="py-4 px-8">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Preconfigured Apps
        </h1>
        <div class="flex gap-4 mt-4">
            <div
                v-for="client in apps"
                class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 ring-1 ring-black dark:ring-gray-700 ring-opacity-5 hover:shadow-lg transition-all duration-300 text-gray-900 dark:text-gray-200 px-8 py-4 cursor-pointer flex flex-col items-center justify-center gap-2"
                @click="emits('appSelected', client)"
            >
                <img
                    :src="client.picture"
                    :alt="`${client.name} picture`"
                    class="h-20 w-20"
                />
                <h1>
                    {{ client.name }}
                </h1>
            </div>
        </div>
    </div>
</template>
