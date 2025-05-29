<template>
    <AppLayout>
        <div class="flex">
            <div class="w-14 flex-none ...">01</div>
            <div id="map" class=""></div>
        </div>


    </AppLayout>
</template>

<script setup>
import AppLayout from './../Layouts/AppLayout.vue';
import { onMounted } from 'vue'
import L from 'leaflet'
// import 'leaflet/dist/leaflet.css'

onMounted(async () => {
    const map = L.map('map').setView([10.9685, -74.7813], 13)

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map)

    const res = await fetch('/api/visit', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')

        }
    })
    const data = await res.json()

    data.result.forEach(v => {

        // console.log(v.latitude, v.longitude)
        const marker = L.marker([v.latitude, v.longitude]).addTo(map)
        marker.bindPopup(`<b>${v.name}</b><br>${v.email}`)
    })
})
</script>
