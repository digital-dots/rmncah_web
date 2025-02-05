<script setup>
import { useSidebarStore } from "@/stores/sidebar";
import { router } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
});

const sidebarStore = useSidebarStore();

const handleItemClick = (url) => {
    sidebarStore.page = props.item.label;

    router.visit(url, {
        preserveScroll: true,
    });
};
</script>

<template>
    <li
        @click="handleItemClick(item.url)"
        class="cursor-pointer hover:bg-black hover:text-white px-3 text-black py-2 rounded-lg"
        :class="{
            'bg-black text-white hover:!bg-black':
                $page.url === item.url ||
                $page.url.startsWith(`${item.url}`)
        }"
    >
        <span>
            {{ item.label }}
        </span>
    </li>
</template>
