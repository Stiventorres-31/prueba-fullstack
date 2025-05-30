<template >
    <header>
        <header class="">
            <NavBar />
        </header>
    </header>
    <div class="">
        <slot />
    </div>
</template>


<script>

export default {
    name: 'AppLayout'
}
</script>

<script setup>
import NavBar from './../Components/NavBar.vue'
</script>
