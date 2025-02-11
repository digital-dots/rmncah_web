<script setup>
import { useSidebarStore } from "@/stores/sidebar";
import { Link } from "@inertiajs/vue3";
import SidebarItemDropdown from "./SidebardItemDropDown.vue";

const sidebarStore = useSidebarStore();

const props = defineProps({
    item: {
        type: Object,
        required: true
    }
});

const handleClick = () => {
    if (props.item.children) {
        sidebarStore.selected = sidebarStore.selected === props.item.label ? '' : props.item.label;
    }
};
</script>

<template>
    <li>
        <!-- Regular menu item without children -->
        <Link
            v-if="!item.children"
            :href="item.url"
            class="cursor-pointer group relative flex items-center text-gray-600 gap-2.5 rounded-lg py-[7px] px-4 duration-300 ease-in-out hover:bg-gray-800 hover:text-white"
            :class="{
                'bg-gray-800 text-white':
                    $page.url.startsWith(item.url) && item.url !== '#',
            }"
            preserve-scroll
            preserve-state
        >
            <i :class="item.icon"></i>
            <span>{{ item.label }}</span>
        </Link>

        <!-- Dropdown menu item with children -->
        <div v-else>
            <div
                @click="handleClick"
                class="cursor-pointer group relative flex items-center justify-between text-gray-600 gap-2.5 rounded-lg py-[7px] px-4 duration-300 ease-in-out hover:bg-gray-800 hover:text-white"
                :class="{
                    'bg-gray-800 text-white': sidebarStore.selected === item.label,
                }"
            >
                <div class="flex items-center gap-2.5">
                    <i :class="item.icon"></i>
                    <span>{{ item.label }}</span>
                </div>
                <i
                    class="fa-solid fa-chevron-down text-sm transition-transform duration-200"
                    :class="{ 'rotate-180': sidebarStore.selected === item.label }"
                ></i>
            </div>

            <!-- Dropdown items -->
            <div
                v-show="sidebarStore.selected === item.label"
                class="overflow-hidden"
            >
                <SidebarItemDropdown
                    v-if="item.children"
                    :items="item.children"
                    :page="$page"
                />
            </div>
        </div>
    </li>
</template>
