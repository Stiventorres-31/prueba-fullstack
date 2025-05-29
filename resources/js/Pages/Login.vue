<template>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto"
                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="handleSubmit" method="POST">
                <div>
                    <label for="identification" class="block text-sm/6 font-medium text-gray-900">Identification</label>
                    <div class="mt-2">
                        <input type="number" v-model="form.identification" name="identification" id="identification"
                            autocomplete="identification" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div>

                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="mt-2">
                        <input type="password" v-model="form.password" name="password" id="password"
                            autocomplete="current-password" required
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>

                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button>
                </div>

                <div v-if="errorMessage" class="text-red-500 text-sm">
                    {{ errorMessage }}
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
const router = useRouter();
const form = ref({
    identification: '',
    password: ''
});

const isLoading = ref(false);
const errorMessage = ref('');
// const handlePostLoginRedirect = async () => {
//     try {
//         $token = sessionStorage.getItem("token")
//         const authCheck = await fetch('/api/user', {
//             credentials: 'include',
//             headers: {
//                 Accept: 'application/json',
//                 Authorization: `Bearer ${token}`
//             }
//         });

//         if (authCheck.ok) {
//             const redirectPath = new URLSearchParams(window.location.search).get('redirect') || '/dashboard';
//             window.location.href = redirectPath;
//         } else {
//             throw new Error('La autenticación no se completó correctamente');
//         }
//     } catch (error) {
//         console.error('Error verificando autenticación:', error);
//         errorMessage.value = 'Ocurrió un error después del login';
//     }
// };
const handleSubmit = async () => {
    isLoading.value = true;
    errorMessage.value = '';

    try {
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(form.value)
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Login failed');
        }

        console.log(data.result )

        if (data.result.token) {
            sessionStorage.setItem('token', data.result.token);
            router.push('dashboard')
            //window.location.href = '/dashboard';
        }

        //await handlePostLoginRedirect()

    } catch (error) {
        errorMessage.value = error.message || 'An error occurred during login';
    } finally {
        isLoading.value = false;
    }


};
</script>
