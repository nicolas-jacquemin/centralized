<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import DangerButton from "@/Components/DangerButton.vue";
import DataList from "@/Components/DataList.vue";
import IconButton from "@/Components/IconButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { ClientModel } from "@/models/ClientModel";
import { useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps<{
    user: any;
    roleEditable: boolean;
    clients: any[];
}>();

const clientsDataList = computed(() =>
    props.clients.map((client) => client.name)
);

const userClients = computed(() =>
    props.user.clients.map((client: ClientModel) => client.name)
);

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: "",
    role: props.user.role,
    clients: userClients.value,
});

const deleteUser = () => {
    form.delete(route("users.destroy", props.user.id));
};

const role = computed({
    get: () => form.role === "admin",
    set: (value) => {
        form.role = value ? "admin" : "user";
    },
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                General Information
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Basic information about this user
            </p>
        </header>

        <form
            @submit.prevent="form.put(route('users.update', user.id))"
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="id" value="User Id" />

                <TextInput
                    id="id"
                    type="text"
                    class="mt-1 block w-full"
                    :model-value="user.id"
                    disabled
                />
            </div>

            <div>
                <InputLabel for="email" value="User Email" />

                <TextInput
                    id="email"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div v-if="roleEditable">
                <InputLabel value="Role" />

                <Checkbox
                    v-model:checked="role"
                    name="role"
                    value="admin"
                    label="Administration rights"
                />
            </div>

            <div>
                <InputLabel value="Apps" />

                <div
                    v-for="(client, index) in form.clients"
                    :key="index"
                    class="flex items-center gap-4 mt-3"
                >
                    <IconButton
                        v-if="index === form.clients.length - 1"
                        icon="plus"
                        class="dark:bg-gray-900 dark:hover:bg-gray-700 dark:text-white"
                        :size="20"
                        @click="form.clients.push('')"
                    />
                    <IconButton
                        v-if="form.clients.length > 0"
                        icon="minus"
                        class="dark:bg-gray-900 dark:hover:bg-gray-700 dark:text-white"
                        :size="20"
                        @click="form.clients.splice(index, 1)"
                    />
                    <DataList
                        v-model="form.clients[index]"
                        :options="clientsDataList"
                        id="client"
                    />
                </div>

                <div class="flex items-center gap-2 pt-2" v-if="form.clients.length === 0">
                    <IconButton
                        icon="plus"
                        class="dark:bg-gray-900 dark:hover:bg-gray-700 dark:text-white"
                        :size="20"
                        @click="form.clients.push('')"
                    />
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        No apps assigned.
                    </p>
                </div>

                <InputError class="mt-2" :message="form.errors.clients" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                <DangerButton @click="deleteUser" :disabled="form.processing"
                    >Delete</DangerButton
                >

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
