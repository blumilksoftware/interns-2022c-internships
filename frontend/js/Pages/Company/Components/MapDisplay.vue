<script setup>
import "maplibre-gl/dist/maplibre-gl.css"
import maplibregl from "maplibre-gl"
import { onMounted, onUnmounted, ref, watch } from "vue"
import { createCompanyMarker, createCollegeMarker } from "./Markers.js"
import assets from "@/assets.json"

const mapContainer = ref()
let loadedMap
let loadedMarkers = []

const props = defineProps({
  markers: Array,
  flyTime: { Number, default: 2000 },
})

defineExpose({
  goTo,
  toggleMarkers,
  resetPosition,
  resetMarkers,
})

function resetPosition() {
  if (loadedMarkers.length === 0) {
    return
  }

  const coordinates = loadedMarkers.map((marker) =>
    marker.loadedMarker.getLngLat(),
  )

  const bounds = new maplibregl.LngLatBounds(coordinates[0], coordinates[0])

  for (const coord of coordinates) {
    bounds.extend(coord)
  }

  if (loadedMarkers.length === 1) {
    loadedMap.flyTo({
      center: coordinates[0],
      zoom: 15,
      duration: props.flyTime,
    })
  } else {
    loadedMap.fitBounds(bounds, {
      padding: 100,
      duration: props.flyTime,
    })
  }
}

function resetMarkers() {
  loadedMarkers.forEach(function (marker) {
    marker.loadedMarker.remove()
  })

  loadedMarkers = []
  loadMarkers()
  resetPosition()
}

function goTo(markerId) {
  if (loadedMarkers.length === 0) {
    return
  }
  let marker = loadedMarkers.find((item) => item.id === markerId)
  if (marker) {
    loadedMap.flyTo({
      center: marker.loadedMarker.getLngLat(),
      zoom: 15,
      duration: props.flyTime,
    })

    marker.loadedMarker.togglePopup()
  }
}

function toggleMarkers() {
  resetPosition()

  loadedMarkers.forEach(function (marker) {
    let htmlElement = marker.loadedMarker.getElement()
    htmlElement.style.opacity = "0.4"
    htmlElement.style.height = "14px"
    htmlElement.style.width = "14px"
  })

  props.markers.forEach(function (marker) {
    let match = loadedMarkers.find((item) => item.id === marker.id)
    if (match) {
      let styledElement = match.loadedMarker.getElement()
      styledElement.style.opacity = "1"
      styledElement.style.height = "20px"
      styledElement.style.width = "20px"
    }
  })
}

watch(
  () => props.markers,
  () => {
    toggleMarkers()
  },
  { deep: true },
)

const emit = defineEmits(["selectedCompany", "loaded"])

function loadMarkers() {
  props.markers.forEach(function (marker) {
    let loadedMarker = createCompanyMarker(marker, loadedMap)
    loadedMarker.getElement().addEventListener("click", function () {
      emit("selectedCompany", marker.id)
    }, { passive: true })
    let id = marker.id
    loadedMarkers.push({ id, loadedMarker })
  })
}

function onMapLoaded() {
  loadedMap.addControl(new maplibregl.NavigationControl())
  loadedMap.addControl(new maplibregl.FullscreenControl())
  loadedMap.addControl(new maplibregl.ScaleControl())
  loadedMap.addControl(new maplibregl.GeolocateControl())
  loadedMap.addControl(new maplibregl.LogoControl())

  loadedMap.on("idle", function () {
    loadedMap.resize()
  })

  let collegeMarker = createCollegeMarker(loadedMap, assets.college.name)
  collegeMarker.getElement().addEventListener("click", function () {
    loadedMap.flyTo({
      center: collegeMarker.getLngLat(),
      zoom: 15,
      duration: props.flyTime,
    })

    collegeMarker.togglePopup()
  }, { passive: true })
  loadMarkers()
  resetPosition()
  emit("loaded")
}

onMounted(() => {
  loadedMap = new maplibregl.Map({
    constrainResolution: true,
    container: mapContainer.value,
    style: `https://api.maptiler.com/maps/streets/style.json?key=${
      import.meta.env.VITE_MAPLIBRE_TOKEN
    }`,
    center: [assets.college.longitude, assets.college.latitude],
    zoom: 15,
    maxZoom: 20,
    doubleClickZoom: false,
    crossSourceCollisions: false,
    failIfMajorPerformanceCaveat: false,
    attributionControl: false,
    preserveDrawingBuffer: true,
    hash: false,
    minPitch: 0,
    maxPitch: 60,
  })

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
