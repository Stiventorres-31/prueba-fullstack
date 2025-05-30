<template>
    <AppLayout>



        <div class="content">
            <div id="map" class="flex-1"></div>
        </div>



    </AppLayout>
</template>

<script setup>

import AppLayout from './../Layouts/AppLayout.vue'
import { onMounted } from 'vue'
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

onMounted(async () => {
    const token = sessionStorage.getItem('token')
    const map = L.map('map').setView([10.9685, -74.7813], 13)

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map)

    const res = await fetch('/api/visit', {
        headers: {
            Authorization: `Bearer ${token}`,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    const data = await res.json()

    data.result.forEach(visit => {

        console.log(visit.latitude, visit.longitude)
        const marker = L.marker([parseFloat(visit.latitude), parseFloat(visit.longitude)]).addTo(map)
        marker.bindPopup(`<b>${visit.name}</b><br>${visit.email}`)
    })
})
</script>

<style scoped>
#map {
    height: 100vh;
}
</style>
