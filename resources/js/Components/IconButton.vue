<template>
    <button :type="type" class="rounded-full p-2 bg-gray-200 hover:bg-gray-300 transition border-none cursor-pointer">
        <mdicon :name="icon" :size="size" />
    </button>
</template>

<script setup lang="ts">
withDefaults(defineProps<{
    icon: string;
    size?: number;
    type?: 'button' | 'submit' | 'reset';
}>(), {
    size: 24,
    type: 'button',
})
</script>
