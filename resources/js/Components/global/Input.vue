<script setup>
defineProps({
  modelValue: {
    type: [String, Number],
    default: ''
  },
  type: {
    type: String,
    default: 'text'
  },
  placeholder: {
    type: String,
    default: ''
  },
  label: {
    type: String,
    default: ''
  },
  error: {
    type: String,
    default: ''
  }
})

defineEmits(['update:modelValue'])
</script>

<template>
  <div>
    <label v-if="label" class="block mb-3 font-medium text-gray-700">
      {{ label }}
    </label>
    
    <input
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      class="w-full px-4 py-2 text-gray-700 bg-white border rounded-lg  focus:ring-0 focus:outline-none focus:border-black"
      :class="{ 'border-red-500': error }"
    >
    
    <p v-if="error" class="mt-1.5 text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>