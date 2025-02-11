<script setup>
import SidebarItem from "@/Components/sidebar/SidebarItem.vue";
import { ref, onMounted } from "vue";
import { Link } from "@inertiajs/vue3";

const userMenus = ref([
    {
        icon: "fa-solid fa-chart-line",
        label: "Dashboard",
        url: "/dashboard",
    },
    // {
    //     icon: "fa-solid fa-person-circle-exclamation",
    //     label: "Roles",
    //     url: "/roles",
    // },
    // {
    //     icon: "fa-solid fa-user",
    //     label: "Users",
    //     url: "/users",
    // },
    {
        icon: "fa-solid fa-layer-group",
        label: "Settings",
        url: "#",
        // permission: ["access_main_title", "access_main_title_text"],
        children: [
            {
                icon: "fa-solid fa-house",
                label: "Roles",
                url: "/roles",
            },
            {
                icon: "fa-solid fa-house-chimney",
                label: "Users",
                url: "/users",
            },
        ],
    },
]);

const sidebarScroll = ref(null);

// Save scroll position before navigation
const saveScrollPosition = () => {
    const scrollPosition = sidebarScroll.value?.scrollTop || 0;
    localStorage.setItem('sidebarScrollPosition', scrollPosition.toString());
};

// Restore scroll position after navigation
onMounted(() => {
    const savedPosition = localStorage.getItem('sidebarScrollPosition');
    if (savedPosition && sidebarScroll.value) {
        sidebarScroll.value.scrollTop = parseInt(savedPosition);
    }
});
</script>

<template>
    <div class="flex">
        <!-- Fixed Sidebar -->
        <div
            class="fixed left-0 top-0 h-screen w-[240px] border-r-[1.5px] border-[#e5e7eb] bg-white"
        >
            <div class="flex gap-2 items-center p-4">
                <div>
                    <p class="mb-1.5 font-semibold">WHO</p>
                </div>
            </div>

            <div class="flex flex-col justify-between h-[calc(100vh-4rem)]">
                <ul 
                    ref="sidebarScroll"
                    class="flex flex-col gap-2.5 pt-4 pb-8 px-2 overflow-y-auto hidden-scrollbar"
                    @scroll="saveScrollPosition"
                >
                    <template v-for="menu in userMenus">
                        <SidebarItem :item="menu" />
                    </template>
                </ul>

                <div class="border-t border-[#e5e7eb]">
                    <ul class="flex flex-col gap-2.5 pt-4 pb-8 px-2">
                        <Link 
                            :href="route('logout')" 
                            method="post" 
                            as="button"
                            @click="localStorage.removeItem('sidebarScrollPosition')"
                        >
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

<style>
.hidden-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.hidden-scrollbar::-webkit-scrollbar {
    display: none;
}
</style>
