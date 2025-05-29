<template>
    <div>
        <h1>Hola {{ userId }}</h1>
    </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
const userId = route.params.id;
</script>

<style lang="scss" scoped></style>
