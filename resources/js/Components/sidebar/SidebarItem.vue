<script setup>
import { useSidebarStore } from "@/stores/sidebar";
import { router } from "@inertiajs/vue3";

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
        <span class="flex items-center gap-3">
            <i :class="item.icon"></i>
            {{ item.label }}
        </span>
    </li>
</template>
