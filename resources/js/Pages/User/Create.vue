<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Form from "./Partials/Form.vue";

defineOptions({ layout: AuthenticatedLayout });

const props = defineProps(["roles"]);
</script>

<template>
    <div class="mx-6">
        <Head title="User Create" />

        <section
            class="max-w-[80em] mx-auto right-0 bottom-0 p-5 mb-6 bg-white rounded-2xl shadow-lg shadow-gray-200 xl:p-6"
        >
            <div class="mb-5">Create User</div>
            <Form :user-roles="roles" :isCreate="true"/>
        </section>
    </div>
</template>
