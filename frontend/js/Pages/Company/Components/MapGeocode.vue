<script setup>
import "maplibre-gl/dist/maplibre-gl.css"
import maplibregl from "maplibre-gl"
import { onMounted, onUnmounted, ref } from "vue"
import LocationIcon from "@/assets/icons/locationIcon.svg"

const mapContainer = ref()
let loadedMap
let locationMarker

function createMarker(center) {
  let markerElement = document.createElement("img")
  markerElement.className = "marker"
  markerElement.src = LocationIcon
  markerElement.style.height = "35px"
  markerElement.style.width = "35px"

  return new maplibregl.Marker(markerElement, { draggable: true }).setLngLat(
    center,
  )
}

defineExpose({
  find,
  getCoordinates,
})

function getQueryUrl(query) {
  query = encodeURIComponent(query)
  return `https://api.maptiler.com/geocoding/${query}.json?key=${import.meta.env.VITE_MAPLIBRE_TOKEN}`
}

async function find(placeName) {
  const response = await fetch(getQueryUrl(placeName))
  const results = await response.json()

  if (results.features[0]) {
    locationMarker.setLngLat(results.features[0].center)
    loadedMap.flyTo({
      center: results.features[0].center,
      zoom: 15,
      duration: 0,
    })
  }
}

function getCoordinates() {
  return locationMarker.getLngLat()
}

function onMapLoaded() {
  loadedMap.addControl(new maplibregl.NavigationControl())
  loadedMap.addControl(new maplibregl.FullscreenControl())
  loadedMap.addControl(new maplibregl.ScaleControl())
  loadedMap.addControl(new maplibregl.LogoControl())
  loadedMap.dragRotate.disable()
  loadedMap.touchZoomRotate.disableRotation()
  locationMarker = createMarker([16.1472681, 51.2048546]).addTo(loadedMap)

  loadedMap.on("idle", function () {
    loadedMap.resize()
  })
}

onMounted(() => {
  loadedMap =
    new maplibregl.Map({
      container: mapContainer.value,
      style: `https://api.maptiler.com/maps/streets/style.json?key=${
        import.meta.env.VITE_MAPLIBRE_TOKEN
      }`,
      center: [16.1472681, 51.2048546],
      zoom: 5,
      maxZoom: 20,
      crossSourceCollisions: false,
      failIfMajorPerformanceCaveat: false,
      attributionControl: false,
      preserveDrawingBuffer: true,
      hash: false,
      minPitch: 0,
      maxPitch: 60,
    }),

  loadedMap.on("load", function () {
    onMapLoaded()
  })
})

onUnmounted(() => {
  loadedMap.remove()
})
</script>

<template>
  <div
    ref="mapContainer"
    class="map h-full w-full"
  />
</template>
