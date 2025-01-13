<script setup lang="ts">
import { onMounted, ref } from "vue";

const model = defineModel<string | undefined>({ required: true });

defineProps<{
    options: string[]
    id: string
}>();

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute("autofocus")) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input ref="input" v-model="model" :list="`${id}-list`" :id="id" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" />
    <datalist :id="`${id}-list`">
        <option v-for="option in options" :value="option" />
    </datalist>
</template>
