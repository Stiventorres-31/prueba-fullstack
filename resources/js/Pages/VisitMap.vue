<template>
  <div id="map" style="height: 100vh;"></div>
</template>

<script setup>
import { onMounted } from 'vue'
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'

onMounted(async () => {
  const map = L.map('map').setView([10.9685, -74.7813], 13)

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map)

  const res = await fetch('/api/visit',{
     headers: {
    'Authorization': 'Bearer 3|ZjIBWYNmbhH8rC3W7bJ1V3poWxAsSFObRPiRLcnta801f000',
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
  })
  const data = await res.json()

  data.result.forEach(v => {

      console.log(v.latitude, v.longitude)
    const marker = L.marker([v.latitude, v.longitude]).addTo(map)
    marker.bindPopup(`<b>${v.name}</b><br>${v.email}`)
  })
})
</script>
