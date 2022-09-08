<script setup>
import 'maplibre-gl/dist/maplibre-gl.css';
import maplibregl from "maplibre-gl";
import {Map} from 'maplibre-gl';
import {markRaw, onMounted, onUnmounted, ref, watch} from "vue";
import '@maptiler/geocoder/css/geocoder.css';
import {createMarker} from "./CompanyMarker.js";

const mapContainer = ref();
let loadedMap;

const props = defineProps({
  markers: Array,
});
let loadedMarkers = [];

defineExpose({
  goTo,
  toggleMarkers,
});

function goTo(markerId) {
  let marker = loadedMarkers.find((item) => item.id === markerId).loadedMarker;

  loadedMap.flyTo({
    center: marker.getLngLat(),
    zoom: 15,
  });
}

function toggleMarkers() {
  loadedMarkers.forEach(function (marker) {
    let htmlElement = marker.loadedMarker.getElement();
    htmlElement.style.opacity = "0.4";
    htmlElement.style.height = "14px";
    htmlElement.style.width = "14px";
  });

  props.markers.forEach(function (marker) {
    let match = loadedMarkers.find((item) => item.id === marker.id);

    if (match !== null) {
      let styledElement = match.loadedMarker.getElement();
      styledElement.style.opacity = "1";
      styledElement.style.height = "20px";
      styledElement.style.width = "20px";
    }
  });
}

watch(
    () => props.markers,
    () => {
      toggleMarkers();
    },
    {deep: true}
);

const emit = defineEmits(["selectedCompany"]);

function loadMarkers() {
  props.markers.forEach(function (marker) {
    let loadedMarker = createMarker(marker, loadedMap);
    loadedMarker.getElement().addEventListener("click", function () {
      emit("selectedCompany", marker.id);
    });
    let id = marker.id;
    loadedMarkers.push({id, loadedMarker});
  });
}

function onMapLoaded() {
  loadedMap.addControl(new maplibregl.NavigationControl());
  loadedMap.addControl(new maplibregl.FullscreenControl());
  loadedMap.addControl(new maplibregl.ScaleControl());
  loadedMap.addControl(new maplibregl.GeolocateControl());
  loadedMap.addControl(new maplibregl.LogoControl());

  loadedMap.dragRotate.disable();
  loadedMap.touchZoomRotate.disableRotation();

  loadedMap.on("idle", function () {
    loadedMap.resize();
  });

  loadMarkers();
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

  loadedMap.on("load", function () {
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
