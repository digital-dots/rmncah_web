<script setup lang="ts">
import { useSidebarStore } from "@/stores/sidebar";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const sidebarStore = useSidebarStore();

interface MenuItem {
    label: string;
    url: string;
    icon: string;
}

const props = defineProps({
    items: {
        type: Array as () => MenuItem[],
        required: true
    },
    page: {
        type: Object,
        required: true
    }
});

const items = ref(props.items);

// const userPermissions = ref([]);

// userPermissions.value = inject('user_permissions')

</script>

<template>
    <ul class="flex flex-col gap-2.5 pl-3 my-2">
        <li v-for="(childItem, index) in items" :key="index">
            <Link
                :href="childItem.url"
                class="cursor-pointer group relative flex items-center text-gray-600 gap-2.5 rounded-lg py-[7px] px-4 duration-300 ease-in-out hover:bg-gray-800 hover:text-white"
                :class="{
                    'bg-gray-800 text-white':
                        page.url === childItem.url ||
                        page.url.startsWith(childItem.url),
                }"
                preserve-scroll
                preserve-state
            >
                <i :class="childItem.icon"></i>
                <span class="text-sm">{{ childItem.label }}</span>
            </Link>
        </li>
    </ul>
</template>
