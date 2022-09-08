<script setup>
import 'maplibre-gl/dist/maplibre-gl.css';
import maplibregl from "maplibre-gl";
import { Map } from 'maplibre-gl';
import { markRaw, onMounted, onUnmounted, ref } from "vue";
import "@maptiler/geocoder/css/geocoder.css"
import {Geocoder} from "@maptiler/geocoder";
import LocationIcon from "@/assets/icons/locationIcon.svg";

const mapContainer = ref();
let loadedMap;
let locationMarker;

function createMarker(center) {
  let markerElement = document.createElement("img");
  markerElement.className = "marker";
  markerElement.src = LocationIcon;
  markerElement.style.height = "20px";
  markerElement.style.width = "20px";

  return new maplibregl.Marker(markerElement, {draggable: true})
      .setLngLat(center);
}

const geocoder = new Geocoder({
  key: import.meta.env.VITE_MAPLIBRE_TOKEN,
});

defineExpose({
  find,
  getCoordinates,
});

async function find(placeName) {
  const response = await fetch(geocoder.getQueryUrl(placeName));
  const results = await response.json();

  if (results.features[0]) {
    locationMarker.setLngLat(results.features[0].center);
    loadedMap.fitBounds(results.features[0].bbox, {maxZoom: 19})
  }
}

function getCoordinates() {
  return locationMarker.center;
}

function onMapLoaded() {
  loadedMap.addControl(new maplibregl.NavigationControl());
  loadedMap.addControl(new maplibregl.FullscreenControl());
  loadedMap.addControl(new maplibregl.ScaleControl());
  loadedMap.addControl(new maplibregl.LogoControl());
  loadedMap.dragRotate.disable();
  loadedMap.touchZoomRotate.disableRotation();
  locationMarker = createMarker([16.1472681, 51.2048546]).addTo(loadedMap);

  loadedMap.on("idle", function () {
    loadedMap.resize();
  });
}

onMounted(() => {
  loadedMap = markRaw(new Map({
    container: mapContainer.value,
    style: `https://api.maptiler.com/maps/streets/style.json?key=${import.meta.env.VITE_MAPLIBRE_TOKEN}`,
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
  }));

  loadedMap.on("load",function () {
    onMapLoaded();
  });
})

onUnmounted(() => {
  loadedMap.remove();
})
</script>

<template>
  <div class="map h-full w-full" ref="mapContainer"></div>
</template>
