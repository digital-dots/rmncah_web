<script setup>
defineProps({
    type: {
        type: String,
        default: 'button'
    },
    disabled: {
        type: Boolean,
        default: false
    },
    variant: {
        type: String,
        default: 'primary', // primary, secondary, danger
        validator: (value) => ['primary', 'secondary', 'danger'].includes(value)
    },
    size: {
        type: String,
        default: 'md', // sm, md, lg
        validator: (value) => ['sm', 'md', 'lg'].includes(value)
    }
})

const sizeClasses = {
    sm: 'px-3 py-1.5 text-sm',
    md: 'px-5 py-2',
    lg: 'px-6 py-2.5 text-lg'
}

const variantClasses = {
    primary: 'bg-black text-white hover:bg-gray-800',
    secondary: 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50',
    danger: 'bg-red-600 text-white hover:bg-red-700'
}
</script>

<template>
    <button
        :type="type"
        :disabled="disabled"
        class="rounded-md cursor-pointer flex items-center gap-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
        :class="[sizeClasses[size], variantClasses[variant]]"
    >
        <slot />
    </button>
</template>
