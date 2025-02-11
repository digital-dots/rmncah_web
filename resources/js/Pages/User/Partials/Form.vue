<script setup>
import { useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import Input from "@/Components/global/Input.vue";
import Button from "@/Components/global/FormButton.vue";

const props = defineProps({
    isCreate: {
        type: Boolean,
    },
    editValue: {
        type: Object,
        default: null,
    },
    userRoles: {
        type: Object,
    },
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    roles: [],
});

const submit = () => {
    const options = {
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            form.errors = errors;
        },
    };

    if(props.isCreate) {
        form.post(route('users.store'), options);
    } else {
        form.put(route('users.update', props.editValue.id), options);
    }
};

onMounted(() => {
    if (!props.isCreate) {
        form.name = props.editValue.name;
        form.email = props.editValue.email;
        form.roles = props.editValue.roles;
    }
});
</script>

<template>
    <form @submit.prevent="submit" class="space-y-6">
        <Input
            v-model="form.name"
            label="Name"
            placeholder="Enter name"
            :error="form.errors.name"
        />

        <Input
            v-model="form.email"
            label="Email"
            placeholder="Enter email"
            :error="form.errors.email"
            type="email"
        />

        <Input
            v-model="form.password"
            label="Password"
            placeholder="Enter password"
            :error="form.errors.password"
            type="password"
        />

        <div class="mt-4">
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">
                    Role <span class="text-red-500">*</span>
                </label>
            </div>
            <div>
                <Multiselect
                    v-model="form.roles"
                    :options="userRoles"
                    :close-on-select="true"
                    :searchable="true"
                    :create-option="false"
                    label="name"
                    track-by="id"
                    placeholder="Select roles"
                    class="multiselect-green"
                />
                <p v-if="form.errors.roles" class="mt-2 text-sm text-red-600">
                    {{ form.errors.roles }}
                </p>
            </div>
        </div>

        <div class="flex justify-end">
            <Button 
                type="submit" 
                :disabled="form.processing"
            >
                Save User
            </Button>
        </div>
    </form>
</template>