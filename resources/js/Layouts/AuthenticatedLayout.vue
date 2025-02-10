<script setup>
import SidebarItem from "@/Components/sidebar/SidebarItem.vue";
import { ref } from "vue";
import { Link } from '@inertiajs/vue3';

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
        <div class="min-h-screen flex overflow-hidden">
            <div
                class="min-w-[240px] h-screen border border-r-[1.5px] border-[#e5e7eb] overflow-y-auto hidden-scrollbar"
            >
                <div class="flex gap-2 items-center p-4">
                    <div>
                        <p class="mb-1.5 font-semibold">WHO</p>
                        <p>Software Engineer</p>
                    </div>
                </div>

                <div
                    class="flex flex-col justify-between h-[calc(100%-5.5rem)]"
                >
                    <ul class="flex flex-col gap-2.5 pt-4 pb-8 px-2">
                        <template v-for="menu in userMenus">
                            <SidebarItem :item="menu" />
                        </template>
                    </ul>
                    <div class="border-t border-[#e5e7eb]">
                        <ul class="flex flex-col gap-2.5 pt-4 pb-8 px-2">
                            <li
                                class="cursor-pointer hover:bg-black hover:text-white px-4 text-black py-2 rounded-lg"
                            >
                                <span>Setting</span>
                            </li>
                            <Link :href="route('logout')" method="post" as="button">
                                <li
                                    class="cursor-pointer hover:bg-black hover:text-white px-4 text-black py-2 rounded-lg text-left"
                                >
                                    <span>Logout</span>
                                </li>
                            </Link>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- main content -->
            <!-- bg-[#f8fbf8] -->
            <!-- fdfcfa -->
            <main class="py-10 max-w-full flex-1 bg-[#f8f8f8] overflow-y-auto hidden-scrollbar">
                <slot />
            </main>
        </div>
    </div>
</template>
