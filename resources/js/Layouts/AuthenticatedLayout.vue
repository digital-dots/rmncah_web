<script setup>
import SidebarItem from "@/Components/sidebar/SidebarItem.vue";
import { ref } from "vue";

const userMenus = ref([
    {
        icon: "home",
        label: "Dashboard",
        url: "/dashboard",
    },
    {
        icon: "home",
        label: "Roles",
        url: "/roles",
    },
]);
</script>

<template>
    <div>
        <div class="min-h-screen flex gap-4 overflow-hidden">
            <div
                class="min-w-[240px] bg-[#fbfbfb] h-screen border border-r-[1.5px] border-[#e5e7eb] overflow-y-auto hidden-scrollbar"
            >
                <div class="flex gap-2 items-center p-4">
                    <div>
                        <p class="mb-1.5 font-semibold">WHO</p>
                        <p>Software Engineer</p>
                    </div>
                </div>

                <ul class="flex flex-col gap-2.5 pt-4 pb-8 px-2">
                    <template v-for="menu in userMenus">
                        <SidebarItem :item="menu" />
                    </template>
                </ul>
            </div>

            <!-- main content -->
            <main class="py-8 flex-1">
                <slot />
            </main>
        </div>
    </div>
</template>
