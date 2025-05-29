<template>
    <AppLayout>
        <div class="p-12">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded shadow text-center">
                    <h2>Create User</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.name" name="name" id="name" autocomplete="name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="identification"
                                class="block text-sm/6 font-medium text-gray-900">Identification</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.identification" name="identification"
                                    id="identification" autocomplete="identification"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                            <div class="mt-2">
                                <input type="password" v-model="form.password" name="password" id="password"
                                    autocomplete="password"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="role" class="block text-sm/6 font-medium text-gray-900">Role</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="role" name="role" autocomplete="role" v-model="form.role"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option>Administrador</option>
                                    <option>Asesor</option>
                                </select>
                                <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                    viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                    </div>

                    <div class="mt-6 flex items-center justify-between w-full">
                        <button
                            class="rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            @click="handleUpdateUser()">Update
                            User</button>

                        <button type="submit" @click="handleCreateUser()"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                            User</button>
                    </div>

                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <h1>Lista de usuarios</h1>

                    <div v-if="error" class="text-red-500">{{ error }}</div>

                    <div v-else class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-4 py-3 font-medium text-gray-500 uppercase">Identificación</th>
                                    <th class="px-4 py-3 font-medium text-gray-500 uppercase">Rol</th>
                                    <th class="px-4 py-3 font-medium text-gray-500 uppercase"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr v-for="user in users" :key="user">

                                    <td class="px-4 py-2 text-gray-700">{{ user.name }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ user.identification }}</td>
                                    <td class="px-4 py-2 text-gray-700">{{ user.role }}</td>
                                    <td class="px-4 py-2 text-gray-700">
                                        <button @click="handleDeleteUser(user.id)">Eliminar|</button>
                                        <button @click="editUser(user.id)">Ver</button>
                                    </td>

                                    <!-- <td class="px-4 py-2 text-gray-700">
                                        <router-link :to="{ name: 'users/show', params: { id: user.id } }">
                                            Ver usuario
                                        </router-link>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Puedes añadir más columnas si lo deseas -->
            </div>

        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import createUser from './../../Utils/Users/createUser.js'
import { onMounted, ref } from 'vue';
import allUser from './../../Utils/Users/ListAllUser.js'
import showUser from './../../Utils/Users/showUser.js'
import { useRouter } from 'vue-router'

const router = useRouter()
const users = ref([]);
const error = ref(null);
const form = ref({
    name: '',
    identification: '',
    password: '',
    role: ''
});

onMounted(async () => {
    try {
        const response = await allUser();
        users.value = response.result
        console.log(users.value)
    } catch (err) {
        error.value = err.message;
    }

})
const handleCreateUser = async () => {
    const response = await createUser(form.value)
    alert(response)
    form.value = {
        name: '',
        identification: '',
        password: '',
        role: ''
    };
    const res = await allUser();
    users.value = res.result;
}
const editingUserId = ref(null);

const editUser = async (user) => {
    try {

        const response = await showUser(user);


        form.value = {
            name: response.result.name,
            identification: response.result.identification,
            password: '',
            role: response.result.role
        };
        editingUserId.value = response.result.id

    } catch (err) {
        error.value = err.message;
    }
};

const handleUpdateUser = async () => {
    alert(editingUserId.value)
}
const handleDeleteUser = async (id) => {
    alert(id)
}

</script>
