<script setup>
import Input from "@/Components/global/Input.vue";
import Pagination from "@/Components/global/Pagination.vue";
import NotFound from "@/Components/global/NotFound.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import { debounce } from "lodash";
import { ref, watch } from "vue";
import Button from "@/Components/global/Button.vue";

defineOptions({ layout: AuthenticatedLayout });

const props = defineProps(["data", "search"]);

const routeName = ref("roles");

const search = ref(props.search);

const deleteItem = (route) => {
    if (confirm("Are you sure you want to delete this role?")) {
        router.delete(route, {
            preserveScroll: true,
            preserveState: true,
        });
    }
};

watch(
    search,
    debounce((value) => {
        router.get(
            "/roles",
            { search: value },
            { preserveState: true, replace: true }
        );
    }, 500)
);
</script>

<template>
    <div class="mx-6">
        <div class="flex justify-between items-center mb-5">
            <Input
                v-model="search"
                type="text"
                class="w-2/6"
                placeholder="Search..."
            />

            <Link :href="route(`${routeName}.create`)">
                <Button>Create Role</Button>
            </Link>
        </div>

        <div
            v-if="data.data.length"
            class="bg-white border rounded-md overflow-hidden shadow-sm sm:rounded-lg"
        >
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left uppercase text-sm">
                            Name
                        </th>
                        <th class="px-6 py-4 uppercase text-end text-sm">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="d in data.data" :key="d.id">
                        <td class="px-6 py-5 whitespace-nowrap text-sm">
                            {{ d.name }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap text-end">
                            <div class="flex gap-4 justify-end">
                                <Link :href="route(`${routeName}.edit`, d.id)" class="text-[#6e6e6e]">
                                    <i class="fa-solid fa-pen"></i>
                                </Link>

                                <button
                                    @click="
                                        deleteItem(
                                            route(`${routeName}.destroy`, d.id)
                                        )
                                    "
                                    class="text-red-400 underline"
                                    type="button"
                                >
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <NotFound 
            v-else 
            :message="search ? 'No roles found matching your search' : 'Loading...'"
        />

        <Pagination :links="data.links" />
    </div>
</template>
