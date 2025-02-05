<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";

defineOptions({ layout: AuthenticatedLayout });

const props = defineProps(["data", "search"]);
</script>

<template>
    <div class="mx-6">
        <div class="flex justify-end mb-5">
            <Link href="/roles/create">
                <div
                    class="bg-black text-white px-5 py-1.5 rounded-md cursor-pointer flex items-center gap-2"
                >
                    <span class="text-xl">+</span>
                    <span>Add Role</span>
                </div>
            </Link>
        </div>

        <div
            class="bg-white border rounded-md overflow-hidden shadow-sm sm:rounded-lg"
        >
            <div class="">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left uppercase">Name</th>
                            <th class="px-6 py-4 uppercase text-end">
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
                                <div class="flex gap-2 justify-end">
                                    <!-- <a
                                        href="#"
                                        class="text-indigo-600 hover:text-indigo-900 underline"
                                    >
                                        Edit
                                    </a>
                                    <a
                                        href="#"
                                        class="text-red-600 hover:text-red-900 underline"
                                    >
                                        Delete
                                    </a> -->
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
