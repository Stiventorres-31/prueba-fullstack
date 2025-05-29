<template>
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <router-link to="/dashboard" class="text-xl font-bold text-gray-800">
                        MiApp
                    </router-link>
                </div>

                <!-- Mobile button -->
                <div class="flex items-center sm:hidden">
                    <button @click="toggleMobileMenu" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop nav -->
                <div class="hidden sm:flex sm:items-center sm:space-x-4">
                    <router-link to="/users" class="text-gray-700 hover:text-blue-600">Usuarios</router-link>
                    <router-link to="/users/1" class="text-gray-700 hover:text-blue-600">Perfil</router-link>
                    <button @click="logout" class="text-red-500 hover:text-red-700">Cerrar sesión</button>
                </div>
            </div>
        </div>

        <!-- Mobile nav -->
        <div v-if="mobileMenuOpen" class="sm:hidden px-4 pb-4">
            <router-link to="/dashboard" class="block py-2 text-gray-700 hover:text-blue-600">Dashboard</router-link>
            <router-link to="/users/1" class="block py-2 text-gray-700 hover:text-blue-600">Perfil</router-link>
            <button @click="logout" class="block py-2 text-red-500 hover:text-red-700">Cerrar sesión</button>
        </div>
    </nav>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const mobileMenuOpen = ref(false)

function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value
}

function logout() {
    const token = sessionStorage.getItem("token")
    fetch('/auth/logout', {
        method: 'POST',
        credentials: 'include',
        headers: {
            Authorization: `Bearer ${token}`,
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(() => {
            sessionStorage.removeItem("token")
            router.push({ name: 'login' })
        })
        .catch((error) => {
            console.error('Logout error:', error)
        })
}
</script>
