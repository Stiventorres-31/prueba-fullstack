<template>
    <AppLayout>
 <div class="">
     <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="bg-white p-6 rounded shadow text-center">
                    <h2>Create Visit</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.name" name="name" id="name" autocomplete="name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="email"
                                class="block text-sm/6 font-medium text-gray-900">Email</label>
                            <div class="mt-2">
                                <input type="email" v-model="form.email" name="email"
                                    id="email" autocomplete="email"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="latitude" class="block text-sm/6 font-medium text-gray-900">Latitude</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.latitude" name="latitude" id="latitude"
                                    autocomplete="latitude"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="longitude" class="block text-sm/6 font-medium text-gray-900">Longitude</label>
                            <div class="mt-2">
                                <input type="text" v-model="form.longitude" name="longitude" id="longitude"
                                    autocomplete="longitude"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                    </div>

                    <div class="mt-6 flex items-center justify-between w-full">
                        <button :disabled="editingVisitId === null"
                            class="rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-yellow-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600 disabled:opacity-50 disabled:cursor-not-allowed"
                            @click="handleUpdateVisit()">Update
                            Visit</button>

                        <button type="submit" @click="emptyForm()"
                            class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">Cancel</button>

                        <button type="submit" @click="handleCreateVisit()" :disabled="editingVisitId !== null"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed">Create
                            Visit</button>
                    </div>

                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <h1>Lists Visits</h1>

                    <div v-if="error" class="text-red-500">{{ error }}</div>

                    <div v-else class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-4 py-3 font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-4 py-3 font-medium text-gray-500 uppercase">Latitude</th>
                                    <th class="px-4 py-3 font-medium text-gray-500 uppercase">Longitude</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr v-for="visit in pagination.data" :key="visit">

                                    <td class="px-1 py-2 text-gray-700">{{ visit.name }}</td>
                                    <td class="px-1 py-2 text-gray-700">{{ visit.email }}</td>
                                    <td class="px-1 py-2 text-gray-700">{{ visit.latitude }}</td>
                                    <td class="px-1 py-2 text-gray-700">{{ visit.longitude }}</td>
                                    <td class="px-1 py-2 text-gray-700">
                                        <button @click="handleDeleteVisit(visit.id)"
                                            class="text-red-500 font-semibold">Eliminar</button>
                                        <span>|</span>
                                        <button class="text-blue-500 font-semibold"
                                            @click="getVisit(visit.id)">Ver</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-4 flex justify-center space-x-1">
    <template v-for="link in pagination.links" :key="link.label">
        <button
            v-if="link.url"
            @click="handleAllVisitPaginate(link.url)"
            v-html="link.label"
            :class="[
                'px-3 py-1 rounded text-sm',
                link.active
                    ? 'bg-indigo-600 text-white font-bold'
                    : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
            ]"
        ></button>
    </template>
</div>


                    </div>
                </div>

            </div>
 </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useRouter } from 'vue-router'
import allVisitsPaginate from './../../Utils/Visits/allVisitsPaginate.js'
import createVisit from './../../Utils/Visits/createVisit.js'
import updateVisit from './../../Utils/Visits/updateVisit.js'
import showVisit from './../../Utils/Visits/showVisit.js'
import deleteVisit from './../../Utils/Visits/deleteVisit.js'
import { onMounted, ref } from 'vue';


// const visits = ref([]);
const error = ref(null);
const editingVisitId = ref(null);
const router = useRouter()
const form = ref({
    name: '',
    email: '',
    latitude: '',
    longitude: ''
});
const pagination = ref({
  data: [],
  current_page: 1,
  last_page: 1,
  next_page_url: null,
  prev_page_url: null
});

onMounted(async () =>{
handleAllVisitPaginate()
})

const handleAllVisitPaginate = async (url) => {
    try {
        const response = await allVisitsPaginate(url);
        pagination.value = response.result;
        emptyForm();
    } catch (err) {
        error.value = err.message;
    }

}
const handleCreateVisit = async () => {
     try {
        const response = await createVisit(form.value);
        visits.value = response.result.data
        handleAllVisitPaginate()
        emptyForm()
    } catch (err) {
        error.value = err.message;
    }
}
const handleDeleteVisit = async (id) => {
    try {
        const response = await deleteVisit(id);
        console.log(response)
        alert(response.message)
        handleAllVisitPaginate()
        emptyForm()
    } catch (err) {
        error.value = err.message;
    }
}
const getVisit = async (id) => {
    try {

        const response = await showVisit(id);
        console.log(response.result)
        form.value={
            name:  response.result.name,
            email:  response.result.email,
            latitude:  response.result.latitude,
            longitude:  response.result.longitude
        };
        
        editingVisitId.value = response.result.id

    } catch (err) {
        error.value = err.message;
    }
}
const handleUpdateVisit = async () => {
    try {
        const response = await updateVisit(form.value, editingVisitId.value);

        console.log(response)
        alert(response.message)
        handleAllVisitPaginate()
        emptyForm()
    } catch (err) {
        error.value = err.message;
    }
}

const emptyForm = () => {
    editingVisitId.value = null
    form.value = {
           name: '',
    email: '',
    latitude: '',
    longitude: ''
    };
}
</script>

<style lang="scss" scoped>

</style>