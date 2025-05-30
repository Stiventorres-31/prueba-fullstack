<template>
  <AppLayout>
    <div class="p-10">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Formulario -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
          <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Create Visit</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Name</label>
              <input v-model="form.name" type="text" id="name" placeholder="Enter name"
                class="block w-full rounded-lg border border-gray-300 p-3 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500" />
            </div>

            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
              <input v-model="form.email" required="required" type="email" id="email" placeholder="Enter email"
                class="block w-full rounded-lg border border-gray-300 p-3 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500" />
            </div>

            <div>
              <label for="latitude" class="block mb-2 text-sm font-medium text-gray-700">Latitude</label>
              <input v-model="form.latitude" type="text" id="latitude" placeholder="Enter latitude"
                class="block w-full rounded-lg border border-gray-300 p-3 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500" />
            </div>

            <div>
              <label for="longitude" class="block mb-2 text-sm font-medium text-gray-700">Longitude</label>
              <input v-model="form.longitude" type="text" id="longitude" placeholder="Enter longitude"
                class="block w-full rounded-lg border border-gray-300 p-3 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500" />
            </div>
          </div>


          <div class="flex flex-col md:flex-row justify-between gap-4 mt-4">
            <button :disabled="editingVisitId === null" @click="handleUpdateVisit"
              class="flex-1 py-3 rounded-lg bg-yellow-500 text-white font-bold hover:bg-yellow-600 disabled:opacity-50 transition">
              Update Visit
            </button>

            <button @click="emptyForm"
              class="flex-1 py-3 rounded-lg bg-gray-600 text-white font-bold hover:bg-gray-700 transition">
              Cancel
            </button>

            <button :disabled="editingVisitId !== null" @click="handleCreateVisit"
              class="flex-1 py-3 rounded-lg bg-indigo-600  text-white font-bold hover:bg-indigo-700 disabled:opacity-50 transition">
              Create Visit
            </button>
          </div>

        </div>

        <!-- Tabla -->
        <div class="bg-white p-8 rounded-xl shadow-lg">
          <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">List Visits</h2>

          <div v-if="error" class="text-center text-red-500">{{ error }}</div>

          <div v-else class="overflow-x-auto max-h-[350px] overflow-y-auto">
            <table class="w-full text-left border-collapse">
              <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                <tr>
                  <th class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis max-w-[150px]">Name</th>
                  <th class="px-6 py-4 whitespace-nowrap overflow-hidden text-ellipsis max-w-[200px]">Email</th>
                  <th class="px-6 py-4">Latitude</th>
                  <th class="px-6 py-4">Longitude</th>
                  <th class="px-6 py-4 text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="visit in pagination.data" :key="visit.id" class="border-b hover:bg-gray-50 transition">
                  <td class="px-6 py-4 text-gray-700">{{ visit.name }}</td>
                  <td class="px-6 py-4 text-gray-700">{{ visit.email }}</td> 
                  <td class="px-6 py-4 text-gray-700">{{ visit.latitude }}</td>
                  <td class="px-6 py-4 text-gray-700">{{ visit.longitude }}</td>
                  <td class="px-6 py-4 text-center space-x-2">
                    <button title="Delete visit" @click="handleDeleteVisit(visit.id)"
                      class="text-red-500 hover:text-red-700 font-bold">
                      🗑️
                    </button>
                    <button title="View visit" @click="getVisit(visit.id)"
                      class="text-blue-500 hover:text-blue-700 font-bold">
                      👁️
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Paginación -->
            <div class="flex justify-center mt-8">
              <template v-for="link in pagination.links" :key="link.label">
                <button v-if="link.url" @click="handleAllVisitPaginate(link.url)" v-html="link.label" :class="[
                  'px-4 py-2 mx-1 rounded-lg text-sm font-semibold',
                  link.active
                    ? 'bg-indigo-600 text-white'
                    : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
                ]"></button>
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


const visits = ref([]);
const error = ref(null);
const errorForm = ref(null);
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

onMounted(async () => {
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
    alert(response.message);


    handleAllVisitPaginate()
    emptyForm()
  } catch (err) {
    errorForm.value = err.message;
  }
}
const handleDeleteVisit = async (id) => {
  if (confirm("Are you sure you want to delete this visit?")) {
    try {

      const response = await deleteVisit(id);
      alert(response.message)
      handleAllVisitPaginate()
      emptyForm()
    } catch (err) {
      error.value = err.message;
    }
  }

}
const getVisit = async (id) => {
  try {

    const response = await showVisit(id);
    console.log(response.result)
    form.value = {
      name: response.result.name,
      email: response.result.email,
      latitude: response.result.latitude,
      longitude: response.result.longitude
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
    console.error(err.message);
    error.value = err.message;
  }
}

const emptyForm = () => {
  errorForm.value = null
  error.value = null
  editingVisitId.value = null
  form.value = {
    name: '',
    email: '',
    latitude: '',
    longitude: ''
  };
}
</script>

<style lang="scss" scoped></style>