<script setup>
import { useSidebarStore } from "@/stores/sidebar";
import { router } from "@inertiajs/vue3";
import { computed } from 'vue';

const props = defineProps({
    item: {
        type: Object,
        required: true
    }
});

const sidebarStore = useSidebarStore();

const isActive = computed(() => {
    const currentUrl = window.location.pathname;
    return currentUrl === props.item.url || 
           currentUrl.startsWith(`${props.item.url}/`) ||
           sidebarStore.page === props.item.label;
});

const handleItemClick = (url) => {
    sidebarStore.page = props.item.label;
    
    router.visit(url, {
        preserveScroll: true,
        showProgress: false,
    });
};
</script>

<template>
    <li
        @click="handleItemClick(item.url)"
        class="cursor-pointer hover:bg-black hover:text-white px-3 text-black py-2 rounded-lg"
        :class="{ 'bg-black text-white': isActive }"
        sidebar-toggle-collapse
    >
    <span sidebar-toggle-item>
        {{ item.label }}
    </span>
    </li>
</template>