<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    isCreate: {
        type: Boolean,
    },
    editValue: {
        type: Object,
        default: null,
    },
    permissionGroups: {
        type: Object,
    },
});

const form = useForm({
    name: "",
    permissions: [],
});

const selectedGroups = ref([]);
const selectAll = ref(false);

const changePermissionGroups = (permissionGroup) => {
    selectedGroups.value = [
        ...new Set([...selectedGroups.value, permissionGroup]),
    ];
};

const removePermissionGroups = (permissionGroup) => {
    const remove_permission_ids = [
        ...new Set(
            [permissionGroup]
                .map((gp) => [...new Set(gp.permissions.map((pm) => pm.id))])
                .flat()
        ),
    ];

    form.permissions = form.permissions.filter(
        (id) => !remove_permission_ids.includes(id)
    );
};

const selectAllHandler = () => {
    selectAll.value = !selectAll.value;

    if (selectAll.value) {
        selectedGroups.value = props.permissionGroups;

        const permission_ids = [
            ...new Set(
                props.permissionGroups
                    .map((gp) => [
                        ...new Set(gp.permissions.map((pm) => pm.id)),
                    ])
                    .flat()
            ),
        ];

        form.permissions = permission_ids;
    } else {
        selectedGroups.value = [];
        form.permissions = [];
    }
};
</script>

<template>
    <form @submit.prevent="submitHandler" method="post" class="">
        <div class="mt-5">
            <div class="mb-3">
                <label>Permission Groups</label>
            </div>
            <div>
                <label class="inline-flex items-center cursor-pointer mb-3">
                    <input
                        type="checkbox"
                        value=""
                        class="sr-only peer"
                        @change="selectAllHandler"
                    />
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-black outline-none"
                    ></div>
                    <span class="ms-3 text-sm font-medium text-gray-900"
                        >Select All</span
                    >
                </label>

                <multiselect
                    :multiple="true"
                    :options="permissionGroups"
                    v-model="selectedGroups"
                    :close-on-select="true"
                    label="name"
                    track-by="id"
                    @select="changePermissionGroups"
                    @remove="removePermissionGroups"
                >
                </multiselect>
            </div>
        </div>

        <div class="mt-8" v-if="selectedGroups.length">
            <div
                v-for="permissionGroup in selectedGroups"
                class="w-full mb-3 bg-white border border-gray-200 rounded-lg p-6 transform transition duration-300 hover:border-indigo-500"
            >
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-md font-semibold text-gray-800">
                        {{ permissionGroup.name }}
                    </h2>
                    <span class="text-sm text-gray-500"
                        >{{
                            permissionGroup.permissions.length
                        }}
                        Permissions</span
                    >
                </div>

                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                >
                    <div
                        class="flex items-center"
                        v-for="permission in permissionGroup.permissions"
                    >
                        <input
                            type="checkbox"
                            :id="permission.name"
                            v-model="form.permissions"
                            :value="permission.id"
                            class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                        />
                        <label
                            :for="permission.name"
                            class="ml-3 text-gray-700"
                            >{{
                                permission.name
                            }}</label
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
        </div>
    </form>
</template>
