<template>
    <AppLayout>
        <div class="p-10">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded shadow text-center">
                    <h2>Create User</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.name" name="name" id="name" autocomplete="name" placeholder="Enter name"
                                    class="block w-full rounded-lg border border-gray-300 p-3 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="identification"
                                class="block mb-2 text-sm font-medium text-gray-700">Identification</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.identification" name="identification"
                                    id="identification" autocomplete="identification" placeholder="Enter identification"
                                    class="block w-full rounded-md border border-gray-300 p-3 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-2">
                                <input type="password" v-model="form.password" name="password" id="password"
                                    autocomplete="password" placeholder="***********"
                                    class="block w-full rounded-md border border-gray-300 p-3 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-700">Role</label>
                            <div class="mt-2 grid grid-cols-1">
                                
                                <select id="role" name="role" autocomplete="role" v-model="form.role"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md border border-gray-300 p-3 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option :selected="form.role === 'Administrator'">Administrator</option>
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

                    <div class="flex flex-col md:flex-row justify-between gap-4 mt-4">
                        <button :disabled="editingUserId === null"
                            class="flex-1 py-3 rounded-lg bg-yellow-500 text-white font-bold hover:bg-yellow-600 disabled:opacity-50 transition disabled:cursor-not-allowed"
                            @click="handleUpdateUser()">Update
                            User</button>

                        <button type="submit" @click="emptyForm()"
                            class="flex-1 py-3 rounded-lg bg-gray-600 text-white font-bold hover:bg-gray-700 transition">Cancel</button>

                        <button type="submit" @click="handleCreateUser()" :disabled="editingUserId !== null"
                            class="flex-1 py-3 rounded-lg bg-indigo-600 text-white font-bold hover:bg-indigo-700 disabled:opacity-50 transition disabled:cursor-not-allowed">Create
                            User</button>
                    </div>

                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <h1>List Users</h1>

                    <div v-if="error" class="text-red-500">{{ error }}</div>

                   <div v-else class="overflow-x-auto">
  <table class="w-full text-left border-collapse">
    <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
      <tr>
        <th class="px-6 py-4">Name</th>
        <th class="px-6 py-4">Identification</th>
        <th class="px-6 py-4">Role</th>
        <th class="px-6 py-4 text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in users" :key="user.id" class="border-b hover:bg-gray-50 transition">
        <td class="px-6 py-4 text-gray-700">{{ user.name }}</td>
        <td class="px-6 py-4 text-gray-700">{{ user.identification }}</td>
        <td class="px-6 py-4 text-gray-700">{{ user.role }}</td>
        <td class="px-6 py-4 text-center space-x-2">
          <button @click="handleDeleteUser(user.id)" class="text-red-500 hover:text-red-700 font-bold">
            Delete
          </button>
          <button @click="editUser(user.id)" class="text-blue-500 hover:text-blue-700 font-bold">
            View
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

                </div>

            </div>

        </div>

    </AppLayout>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import createUser from './../../Utils/Users/createUser.js'
import updateUser from './../../Utils/Users/updateUser.js'
import deleteUser from './../../Utils/Users/deleteUser.js'
import { onMounted, ref } from 'vue';
import allUser from './../../Utils/Users/ListAllUser.js'
import showUser from './../../Utils/Users/showUser.js'
import { useRouter } from 'vue-router'
const editingUserId = ref(null);
const router = useRouter()
const users = ref([]);
const error = ref(null);
const form = ref({
    name: '',
    identification: '',
    password: '',
    role: 'Administrator'
});
// Listamos a los usuarios con la construccion de la pagina
onMounted(async () => {

    handleAllUser()
})

// Action para realizar la peticion de crear usuario
const handleCreateUser = async () => {
    const response = await createUser(form.value)
    alert(response)
    handleAllUser()
    emptyForm()

}

// Action para ver la informacion del usuario al seleccionarlo en la tabla
// se cargan en el formulario


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

    try {
        const response = await updateUser(form.value, editingUserId.value);

        console.log(response)
        alert(response.message)
        handleAllUser()
        emptyForm()
    } catch (err) {
        error.value = err.message;
    }
}
const handleDeleteUser = async (id) => {
    try {
        const response = await deleteUser(id);

        console.log(response)
        alert(response.message)
        handleAllUser()
        emptyForm()
    } catch (err) {
        error.value = err.message;
    }
}

const handleAllUser = async () => {
    try {
        const response = await allUser();
        users.value = response.result

    } catch (err) {
        error.value = err.message;
    }

}

const emptyForm = () => {
    editingUserId.value = null
    form.value = {
        name: '',
        identification: '',
        password: '',
        role: ''
    };
}
</script>
