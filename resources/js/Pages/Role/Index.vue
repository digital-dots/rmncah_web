<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineOptions({ layout: AuthenticatedLayout });
</script>

<template>
    <div class="mx-6">
        <div
            class="bg-white border rounded-md overflow-hidden shadow-sm sm:rounded-lg"
        >
            <div class="">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left font-semibold uppercase tracking-wider"
                            >
                                Name
                            </th>
                            <th
                                class="px-6 py-4 font-semibold uppercase tracking-wider text-center"
                            >
                                Description
                            </th>
                            <th
                                class="px-6 py-4 font-semibold uppercase tracking-wider text-end"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-5 whitespace-nowrap text-sm">
                                Admin
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm w-full text-center">
                                Administrator role
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-end">
                                <div class="flex gap-2 justify-end">
                                    <a
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
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
