<script setup>
import SidebarItem from "@/Components/sidebar/SidebarItem.vue";
import { ref } from "vue";
import { Link } from '@inertiajs/vue3';

const userMenus = ref([
    {
        icon: "fa-solid fa-chart-line",
        label: "Dashboard",
        url: "/dashboard",
    },
    {
        icon: "fa-solid fa-person-circle-exclamation",
        label: "Roles",
        url: "/roles",
    },
    {
        icon: "fa-solid fa-person-circle-exclamation",
        label: "Users",
        url: "/users",
    },
]);
</script>

<template>
    <div class="flex">
        <!-- Fixed Sidebar -->
        <div class="fixed left-0 top-0 h-screen w-[240px] border-r-[1.5px] border-[#e5e7eb] bg-white">
            <div class="flex gap-2 items-center p-4">
                <div>
                    <p class="mb-1.5 font-semibold">WHO</p>
                </div>
            </div>

            <div class="flex flex-col justify-between h-[calc(100vh-4rem)]">
                <ul class="flex flex-col gap-2.5 pt-4 pb-8 px-2">
                    <template v-for="menu in userMenus">
                        <SidebarItem :item="menu" />
                    </template>
                </ul>
                
                <div class="border-t border-[#e5e7eb]">
                    <ul class="flex flex-col gap-2.5 pt-4 pb-8 px-2">
                        <Link :href="route('logout')" method="post" as="button">
                            <li class="cursor-pointer hover:bg-black hover:text-white px-4 text-black py-2 rounded-lg text-left">
                                <span class="flex items-center gap-3">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Logout
                                </span>
                            </li>
                        </Link>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-[240px]">
            <main class="pt-12 pb-10 px-2 min-h-screen bg-[#f8f8f8]">
                <slot />
            </main>
        </div>
    </div>
</template>