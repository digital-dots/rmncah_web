<script setup>
defineProps({
    message: {
        type: String,
        default: 'No records found'
    }
})
</script>

<template>
    <div class="flex flex-col items-center justify-center h-[calc(100vh-200px)] p-8 text-center rounded-lg">
        <h3 class="mb-2 font-medium text-gray-700">{{ message }}</h3>
    </div>
</template>
