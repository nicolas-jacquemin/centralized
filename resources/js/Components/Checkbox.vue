<script setup lang="ts">
import { computed } from "vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps<{
    checked: boolean;
    value?: any;
    label?: string;
}>();

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>

<template>
    <div class="flex items-center gap-2 px-1 cursor-pointer" @click="proxyChecked = !proxyChecked">
        <input
            type="checkbox"
            :value="value"
            v-model="proxyChecked"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
        />
        <p v-if="label">{{ label }}</p>
    </div>
</template>
